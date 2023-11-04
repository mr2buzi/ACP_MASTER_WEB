<?php
require_once('config.php');

$message = ''; // Initialize the message variable

if (isset($_POST['signupbtn'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password != $confirmpassword) {
        $message = 'Error: Passwords do not match.';
    } elseif (strlen($password) < 8) {
        $message = 'Error: Password must be at least 8 characters long.';
    } else {
        // Check if the username or email already exists
        $sql_check = "SELECT username, email FROM useraccounts WHERE username = ? OR email = ?";
        $stmt_check = $db->prepare($sql_check);
        $stmt_check->execute([$username, $email]);
        $existingUser = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            if ($existingUser['username'] === $username) {
                $message = 'Duplicate username.';
            } elseif ($existingUser['email'] === $email) {
                $message = 'Duplicate email.';
            }
        } else {
            // Hash the password (use a secure hashing method)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the data into the database
            $sql_insert = "INSERT INTO useraccounts (name, surname, username, email, password) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $db->prepare($sql_insert);
            $result = $stmt_insert->execute([$name, $surname, $username, $email, $hashed_password]);

            if ($result) {
                // Registration successful
                $message = 'Registration successful.';
            } else {
                $message = 'Error: Couldn\'t save data.';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css_login/form.css">

</head>
<body>
    <div class="message">
        <?php echo $message; // Display PHP messages here ?>
    </div>
    <form method="post" action="sign_up.php">
        <div class="form">
            <h1 class="heading">Sign Up</h1>
            <input type="name" placeholder="name" id="name" autocomplete="off" class="name" required name="name">
            <input type="surname" placeholder="surname" id="surname" autocomplete="off" class "surname" required name="surname">
            <input type="username" placeholder="username" id="username" autocomplete="off" class="username" required name="username">
            <input type="email" placeholder="email" id="email" autocomplete="off" class="email" required name="email">
            <input type="password" placeholder="password" id="password" autocomplete="off" class="password" required name="password">
            <span class="password-error">Minimum 8 characters</span>
            <input type="password" placeholder="confirm password" id="confirmpassword" autocomplete="off" class="confirmpassword" required name="confirmpassword">
            <button class="submit-btn" type="submit" id="register" name="signupbtn">Sign Up</button>
            <a href="login.php" src="login.php" class="link">Log In</a>
        </div>
    </form>
</body>
</html>

<script>
    // Get the password input and the password error span
    const passwordInput = document.getElementById('password');
    const passwordError = document.querySelector('.password-error');

    // Listen for input in the password field
    passwordInput.addEventListener('input', function () {
        if (passwordInput.value.length < 8) {
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    });
</script>
