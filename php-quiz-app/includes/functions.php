<?php
function getQuizzes($conn, $filter = null) {
    $query = "SELECT * FROM quizzes";
    if ($filter) {
        $query .= " WHERE category = :filter";
    }
    $stmt = $conn->prepare($query);
    if ($filter) {
        $stmt->bindParam(':filter', $filter);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getQuizQuestions($conn, $quiz_id) {
    $stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $quiz_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function validateUserInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function calculateScore($userAnswers, $correctAnswers) {
    $score = 0;
    foreach ($userAnswers as $key => $answer) {
        if ($answer === $correctAnswers[$key]) {
            $score++;
        }
    }
    return $score;
}

function saveResult($conn, $user_id, $quiz_id, $score) {
    $stmt = $conn->prepare("INSERT INTO results (user_id, quiz_id, score, created_at) VALUES (:user_id, :quiz_id, :score, NOW())");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':quiz_id', $quiz_id);
    $stmt->bindParam(':score', $score);
    return $stmt->execute();
}

function getQuizById($quiz_id) {
    global $conn; // Assuming $conn is your PDO database connection
    $stmt = $conn->prepare("SELECT * FROM quizzes WHERE id = :quiz_id");
    $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getQuestionsByQuizId($quiz_id) {
    global $conn; // Assuming $conn is your PDO database connection
    $stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function authenticateUser($username, $password) {
    global $conn;

    // Prepare the SQL statement to fetch the user by username
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user record
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit();
    }

    // Compare the plain text password
    if ($password !== $user['password']) {
        echo json_encode(['status' => 'error', 'message' => 'Password mismatch']);
        exit();
    }

    return $user;
}
?>