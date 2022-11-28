<?php

namespace App;

use PDO;

class Request {
  private PDO $conn;

  public function __construct() {
    $db = new Database();
    $this->conn = $db->get_conn();
  }

  public function response() {
    /*==== For render Form ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_quests') {
      $stm = $this->conn->prepare('CALL get_quests(:form_id);');
      $stm->execute([ 'form_id' => $_GET['form'] ]);
      $quests = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($quests);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_options') {
      $stm = $this->conn->prepare('CALL get_options(:id_quest);');
      $stm->execute([ 'id_quest' => $_GET['quest']]);
      $options = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($options);
      http_response_code(200);
      return;
    }

    /*==== Check if exist the email in the BD ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'check_email') {
      $stm = $this->conn->prepare('
        CALL check_email(:email);
      ');
      $stm->execute([ 'email' => $_GET['email'] ]);
      $user_email = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($user_email);
      http_response_code(200);
      return;
    }

    /*==== Check if exist previous answers by a user in a form ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'exist_answers') {
      $stm = $this->conn->prepare('CALL exist_answers(:form_id,:email);');
      $stm->execute([
        'form_id' => $_GET['form_id'],
        'email' => $_GET['email']
      ]);
      $answers = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($answers);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['req'] == 'add_answers') {
      $stm = $this->conn->prepare('CALL add_answers(:answer, :quest_id, :email);');
      $stm->execute([
        ':answer' => $_POST['answer'],
        ':quest_id' => $_POST['quest_id'],
        ':email' => $_POST['email']
      ]);
      return;
    }

    echo 'Operation not available';
    http_response_code(400);
    return;
  }
}
