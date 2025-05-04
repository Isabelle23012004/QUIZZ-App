<?php
session_start();
include '../includes/db_connect.php';
include '../includes/functions.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['quiz_id']) || !isset($_SESSION['score'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$quiz_id = $_SESSION['quiz_id'];
$score = $_SESSION['score'];
$quiz_title = getQuizTitle($quiz_id, $conn); // Function to fetch quiz title

// Clear session data
unset($_SESSION['quiz_id']);
unset($_SESSION['score']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Quiz Result</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($quiz_title); ?></h5>
                <p class="card-text">Your Score: <?php echo htmlspecialchars($score); ?></p>
                <a href="quiz.php?id=<?php echo htmlspecialchars($quiz_id); ?>" class="btn btn-primary">Retake Quiz</a>
                <a href="index.php" class="btn btn-secondary">Return to Homepage</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>