<?php
session_start();
require_once __DIR__ . '/User.php';

$user = new User();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login test</title>
  <style media="screen">
    label {
      display: inline-block;
      width: 7em;
    }
  </style>
</head>
<body>
  <?php
  echo $user->loginForm();
   ?>
</body>
</html>