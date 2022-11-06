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
      $stm = $this->conn->prepare('SELECT * FROM questions WHERE id_form = :form_id');
      $stm->execute([ 'form_id' => $_GET['form'] ]);
      $quests = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($quests);
      http_response_code(200);
      return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'get_options') {
      $stm = $this->conn->prepare('SELECT * FROM optionss WHERE id_question = :id_quest');
      $stm->execute([ 'id_quest' => $_GET['quest']]);
      $options = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($options);
      http_response_code(200);
      return;
    }

    echo 'Operation not available';
    http_response_code(400);
    return;
  }
}

?>