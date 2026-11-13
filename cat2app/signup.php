<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $_POST['username'], $_POST['fullname'], $_POST['email'], $hash);
    $msg = $stmt->execute() ? "Registered successfully. <a href='login.php'>Login</a>" : "Error: " . $conn->error;
}
?>
<!DOCTYPE html>
<html><head><title>Sign Up</title></head>
<body>
<h2>Sign Up</h2>
<p><?= $msg ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required><br>
  <input name="fullname" placeholder="Full name"><br>
  <input name="email" type="email" placeholder="Email"><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <button type="submit">Register</button>
</form>
<a href="login.php">Already registered? Login</a>
</body></html>
