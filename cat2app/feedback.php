<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?,?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['message']);
    $msg = $stmt->execute() ? "Feedback saved." : "Error: " . $conn->error;
}
$res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Feedback</title></head>
<body>
<h2>Feedback Form</h2>
<p><?= $msg ?></p>
<form method="POST">
  <input name="name" placeholder="Your name" required><br>
  <textarea name="message" placeholder="Your feedback" required></textarea><br>
  <button type="submit">Submit</button>
</form>
<h3>Submitted feedback</h3>
<?php while ($r = $res->fetch_assoc()): ?>
  <p><b><?= htmlspecialchars($r['name']) ?></b>: <?= htmlspecialchars($r['message']) ?> (<?= $r['submitted_at'] ?>)</p>
<?php endwhile; ?>
</body></html>
