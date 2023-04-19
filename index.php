<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

$db = new mysqli('localhost', 'username', 'password', 'dbname');
if ($db->connect_errno) {
    die('Nie udało się połączyć z bazą danych: ' . $db->connect_error);
}

$stmt = $db->prepare('SELECT email FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strona główna</title>
</head>
<body>
</h1>
    <p>Witaj, <?php echo $username; ?>!</p>
    <p>Twój adres e-mail to: <?php echo $email; ?></p>
    <a href="logout.php">Wyloguj się</a>
</body>
</html>