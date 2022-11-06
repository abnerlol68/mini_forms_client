<?php
  use App\Database;
  $db = new Database();
  $conn = $db->get_conn();
  
  $errMsg = null;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for no empty input email
    if (empty($_POST['email'])) {
      $errMsg = "Ingresa un correo valido.";
      return;
    }

    $_SESSION['user'] = $_POST['email'];
    $form = $_GET['form_id'];
    $email = $_POST['email'];

    // If in the URL doesn't exist a form_id, go to not found
    if (empty($form)) {
      require_once ROOT . 'src/View/NotFound.php';
      return;
    }

    $res = file_get_contents(
      URL . 'request/?req=exist_answers&email=' . $email . 
      "&form_id=" . $form
    );
    $answers = json_decode($res);

    // If exist answer by an user in a form, go to thanks page
    if (sizeof($answers) > 0) {
      header('Location: ' . URL . 'thanks');
      return;
    }

    // Go to poll (form)
    header('Location: ' . URL . 'form/?form_id=' . $form);
    return;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="form" style="display: none;"><?= $_GET['form_id'] ?></p>
  <p id="session" style="display: none;"><?= var_dump($_SESSION) ?></p>
  
  <h2>Login</h2>
  <main>
    <form method="post" action="#">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      <!-- <input type="submit" value="Entrar" id="submit"> -->
      <button type="submit" id="submit">Entrar</button>
    </form>
  </main>
</body>
</html>