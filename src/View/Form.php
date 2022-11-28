<?php
  // var_dump($_POST);
  // die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="<?= URL . 'src/App/Form.js' ?>" type="module"></script>
  <title>Form</title>
    <link rel="stylesheet" href="<?= URL . 'src/css/form.css' ?>">
    <link rel="shortcut icon" href="<?= URL . 'src/img/favicon.png' ?>" type="image/x-icon">
</head>
<body>
  <p id="url" style="display: none;"><?= URL ?></p>
  <p id="form_id" style="display: none;"><?= $_GET['form_id'] ?></p>
  <main>
    <form action="<?= URL . 'submit/?form_id=' . $_GET['form_id'] ?>" method="POST">

    </form>
  </main>
</body>
</html>