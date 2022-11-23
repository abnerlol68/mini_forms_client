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

    $res_email = file_get_contents(
      URL . 'request/?req=check_email&email=' . $email
    );
    $user_email = json_decode($res_email);
    
    if (sizeof($user_email) !== 0) {
      $res_ans = file_get_contents(
        URL . 'request/?req=exist_answers&email=' . $email . 
        "&form_id=" . $form
      );
      $answers = json_decode($res_ans);
  
      // If exist answer by an user in a form, go to thanks page
      if (sizeof($answers) > 0) {
        header('Location: ' . URL . 'thanks');
        return;
      }
  
      // Go to poll (form)
      header('Location: ' . URL . 'form/?form_id=' . $form);
      return;
    }

    $errMsg = 'No puedes acceder';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
    <link rel="stylesheet" href="src/css/login.css">
</head>
<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="form" style="display: none;"><?= $_GET['form_id'] ?></p>
  <p id="session" style="display: none;"><?= var_dump($_SESSION) ?></p>
  
  <main id="body-login">

      <div class="area" >
          <ul class="circles">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
          </ul>
      </div >

    <div class="wrapper">
        <h1 class="wrapper__title">Corroboremos tus datos :)</h1>
        <form method="post" action="#" class="wrapper__form">

            <input type="email" name="email" id="email" class="material-text input-text" required>
            <!-- <input type="submit" value="Entrar" id="submit"> -->
            <button type="submit" id="submit" class="bubbly-button">Entrar</button>
<!--            <button class="custom-btn btn-15">Read More</button>-->
            <label for="email" class="wrapper__form-label">Correo</label>
        </form>
        <?php if ($errMsg): ?>
            <!-- The style is temporal -->
            <p class="text-danger" style="color: red;"><?= $errMsg ?></p>
        <?php endif ?>
    </div>
  </main>
</body>
</html>