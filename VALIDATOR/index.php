<?php
class InputValidator
{
    public static function isEmpty($value)
    {
        return empty($value);
    }

    public static function isSet($value)
    {
        return isset($value);
    }

    public static function isNumeric($value)
    {
        return is_numeric($value);
    }

    public static function isValidEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function isValidUsername($value)
    {
        return preg_match("/^[a-zA-Z0-9]+$/", $value);
    }

    public static function hasMinLength($value, $minLength)
    {
        return strlen($value) >= $minLength;
    }

    public static function isAlpha($value)
    {
        return ctype_alpha($value);
    }

    public static function isDigit($value)
    {
        return ctype_digit($value);
    }

    public static function isAlphaNumeric($value)
    {
        return ctype_alnum($value);
    }

    public static function isStrongPassword($value)
    {
        // Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character
        $pattern = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/';
        return preg_match($pattern, $value);
    }
}

// Usage examples
if (InputValidator::isEmpty($_POST['username'])) {
    // Handle the error
}

if (!InputValidator::isSet($_POST['email'])) {
    // Handle the error
}

if (!InputValidator::isNumeric($_POST['age'])) {
    // Handle the error
}

if (!InputValidator::isValidEmail($_POST['email'])) {
    // Handle the error
}

if (!InputValidator::isValidUsername($_POST['username'])) {
    // Handle the error
}

if (!InputValidator::hasMinLength($_POST['password'], 8)) {
    // Handle the error
}

if (!InputValidator::isAlpha($_POST['name'])) {
    // Handle the error
}

if (!InputValidator::isDigit($_POST['age'])) {
    // Handle the error
}

if (!InputValidator::isAlphaNumeric($_POST['username'])) {
    // Handle the error
}

if (!InputValidator::isStrongPassword($_POST['password'])) {
    // Handle the error
}

?>
