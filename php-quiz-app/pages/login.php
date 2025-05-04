<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        $user = authenticateUser($username, $password); // Function to validate user credentials

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Please provide both username and password']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}
?>