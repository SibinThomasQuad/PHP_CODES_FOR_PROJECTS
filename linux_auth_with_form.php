<?php

function authenticateUser($username, $password) {
    $shadowFile = '/etc/shadow';

    try {
        $lines = file($shadowFile, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $fields = explode(':', $line);
            if ($fields[0] === $username) {
                $storedHash = $fields[1];
                $salt = substr($storedHash, 0, strrpos($storedHash, '$') + 1);
                $enteredHash = crypt($password, $salt);
                return $storedHash === $enteredHash;
            }
        }
    } catch (Exception $e) {
        return false;
    }
    
    return false;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (authenticateUser($username, $password)) {
        $message = "Authentication successful!";
    } else {
        $message = "Authentication failed.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
