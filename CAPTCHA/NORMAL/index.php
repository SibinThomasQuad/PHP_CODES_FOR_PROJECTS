<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP CAPTCHA</title>
</head>
<body>
    <h2>Simple PHP CAPTCHA Example</h2>
    <form method="post" action="verify_captcha.php">
        <img src="captcha.php" alt="CAPTCHA Image"><br>
        <label for="captcha_input">Enter the code above:</label>
        <input type="text" name="captcha_input" required>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
