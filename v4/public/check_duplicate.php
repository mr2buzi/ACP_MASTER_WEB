<?php
require_once('config.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Query to check if the email already exists in the database
    $sql = "SELECT COUNT(*) FROM login_deets.useraccounts WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Email already exists
        echo 'duplicate_email';
    } else {
        // Email is unique
        echo 'unique_email';
    }
} elseif (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Query to check if the username already exists in the database
    $sql = "SELECT COUNT(*) FROM login_deets.useraccounts WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Username already exists
        echo 'duplicate_username';
    } else {
        // Username is unique
        echo 'unique_username';
    }
} else {
    // No data sent
    echo 'no_data';
}
?>

