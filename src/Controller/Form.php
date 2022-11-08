<?php
  try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // $answers = '';
      foreach ($_POST as $question => $answer) {
        $quest_id = intval(substr($question, 12));
        
        if (gettype($answer) === "array") {
          foreach ($answer as $ans) {
            // $answers .= '('.$ans.', '. $quest_id.','.$_SESSION['user'].'),';
            $context = stream_context_create([ 'http' => [
              "header" => "Content-type: application/x-www-form-urlencoded\r\n",
              'method' => 'POST',
              'content' => http_build_query([
                'answer' => $ans,
                'quest_id' => $quest_id,
                'email' => $_SESSION['user']
              ])
            ] ]);

            $res = file_get_contents(URL . 'request/?req=add_answers', false, $context);
          }
          continue;
        }
        // $answers .= '('.$answer.', '. $quest_id.','.$_SESSION['user'].'),';
        $context = stream_context_create([ 'http' => [
          "header" => "Content-type: application/x-www-form-urlencoded\r\n",
          'method' => 'POST',
          'content' => http_build_query([
            'answer' => $answer,
            'quest_id' => $quest_id,
            'email' => $_SESSION['user']
          ])
        ] ]);

        $res = file_get_contents(URL . 'request/?req=add_answers', false, $context);
      }

      // $answers_ready = substr($answers, 0, strlen($answers) - 1);

      // $context = stream_context_create([ 'http' => [
      //   "header" => "Content-type: application/x-www-form-urlencoded\r\n",
      //   'method' => 'POST',
      //   'content' => http_build_query([$answers_ready])
      // ] ]);

      // $res = file_get_contents(URL . 'request/?req=add_answers', false, $context);

      header('Location: ' . URL . 'thanks');
    }
  } catch (\Throwable $th) {
    echo '<pre>';
      echo $th;
    echo '</pre>';
  }
