<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $redirectUrl = isset($_POST['redirect']) ? $_POST['redirect'] : 'profile.php'; // Default to profile.php

    if (!empty($username) && !empty($password)) {
        $user = authenticateUser($username, $password); // Function to validate user credentials

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ' . $redirectUrl);
            exit();
        } else {
            header('Location: profile.php?error=invalid');
            exit();
        }
    } else {
        header('Location: profile.php?error=invalid');
        exit();
    }
}
?>