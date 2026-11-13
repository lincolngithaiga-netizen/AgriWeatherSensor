<?php
session_start();
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['user'] = $_POST['username'];
        $msg = "Welcome, " . htmlspecialchars($_SESSION['user']) . "! Login successful.";
    } else {
        $msg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html><head><title>Login</title></head>
<body>
<h2>Login</h2>
<p><?= $msg ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
</form>
<a href="signup.php">Need an account? Sign up</a>
</body></html>
