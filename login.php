<?php
session_start();
include "config/db.php";
if (isset($_POST['login'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  if ($user=="admin" && $pass=="admin") {
    $_SESSION['admin'] = $user;
    header("Location: admin/dashboard.php");
  } else {
    $error = "Login gagal!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2>Login Admin</h2>
  <form method="post">
    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control"></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control"></div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </form>
  <?php if(isset($error)) echo "<div class='alert alert-danger mt-3'>$error</div>"; ?>
</div>
</body>
</html>