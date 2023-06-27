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
        echo "Error: " . $e->getMessage();
        return false;
    }
    
    return false;
}

// Usage example
$username = $_POST['username'];
$password = $_POST['password'];

if (authenticateUser($username, $password)) {
    echo "Authentication successful!";
} else {
    echo "Authentication failed.";
}

?>
