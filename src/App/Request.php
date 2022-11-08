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

    /*==== Check if exist the email in the BD ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'check_email') {
      $stm = $this->conn->prepare('
        SELECT email_graduate FROM graduates 
        WHERE email_graduate = :email
      ');
      $stm->execute([ 'email' => $_GET['email'] ]);
      $user_email = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($user_email);
      http_response_code(200);
      return;
    }

    /*==== Check if exist previous answers by an user in a form ====*/

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['req'] == 'exist_answers') {
      $stm = $this->conn->prepare('
        SELECT quests.id_form, quests.id_question, ans.id_answer, ans.email_graduate
        FROM answers AS ans
        JOIN questions AS quests
        ON ans.id_question = quests.id_question
        WHERE quests.id_form = :form_id AND ans.email_graduate = :email
      ');
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
      // $stm = $this->conn->prepare('
      //   INSERT INTO answers (answer_answer, id_question, email_graduate) 
      //   VALUES :answers;
      // ');
      // $stm->execute([ 'answers' => $_POST[0] ]);

      $stm = $this->conn->prepare('
        INSERT INTO answers (answer_answer, id_question, email_graduate) 
        VALUES (:answer, :quest_id, :email)
      ');
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

?>