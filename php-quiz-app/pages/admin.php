<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}

$quizzes = fetchAllQuizzes();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_quiz'])) {
        $title = $_POST['title'];
        createQuiz($title);
        header('Location: admin.php');
        exit();
    }
}

function fetchAllQuizzes() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM quizzes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createQuiz($title) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO quizzes (title, created_at) VALUES (?, NOW())");
    $stmt->execute([$title]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quiz Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <form method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Quiz Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <button type="submit" name="create_quiz" class="btn btn-primary">Create Quiz</button>
        </form>

        <h2>Existing Quizzes</h2>
        <ul class="list-group">
            <?php foreach ($quizzes as $quiz): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($quiz['title']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>