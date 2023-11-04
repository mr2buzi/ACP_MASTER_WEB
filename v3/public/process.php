<?php
require_once('config.php');

if (isset($_POST['signupbtn'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check if passwords match
    if ($password != $confirmpassword) {
        echo 'error_password';
    } else {
        // Check if the username is already in the database
        $sql = "SELECT COUNT(*) FROM login_deets.useraccounts WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Username already exists, return an error
            echo 'duplicate_username';
        } else {
            // Hash the password (you should use a secure hashing method)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and execute the SQL query to insert the data into the database
            $sql = "INSERT INTO login_deets.useraccounts (name, surname, username, email, password) VALUES (?, ?, ?, ?, ?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$name, $surname, $username, $email, $hashed_password]);

            if ($result) {
                echo 'success';
            } else {
                echo 'error_database';
            }
        }
    }
}
?>