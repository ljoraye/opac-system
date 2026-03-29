<?php
session_start();

// If form submitted
if (isset($_POST['password'])) {
    $password = $_POST['password'];

    // Set your chosen password here
    $correct_password = "opac123";

    if ($password === $correct_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Incorrect password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="archiva.css">
</head>
<body>
  <h2>Admin Access</h2>
  <form method="POST">
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
  <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

  <div style="margin-top:10px;">
    <a href="index.php"><button type="button">Return to Title Page</button></a>
  </div>
</body>
</html>
