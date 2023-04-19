<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $errors = array();
    if (empty($username)) {
        $errors[] = 'Nazwa użytkownika jest wymagana';
    }
    if (empty($password)) {
        $errors[] = 'Hasło jest wymagane';
    }

    
    if (empty($errors)) {
        $db = new mysqli('localhost', 'username', 'password', 'dbname');
        if ($db->connect_errno) {
            die('Nie udało się połączyć z bazą danych: ' . $db->connect_error);
        }

        $stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
          
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Nieprawidłowa nazwa użytkownika lub hasło';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
</head>
<body>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post">
        <div>
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </div>
        <div>
            <label for="password">Hasło:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Zaloguj">
        </div>
    </form>
</body>
</html>