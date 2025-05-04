<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

// Remove the login check and redirection
// if (!isset($_SESSION['user_id'])) {
//     header('Location: index.php');
//     exit();
// } else {
//     // Redirect to profile page if already logged in
//     header('Location: profile.php');
//     exit();
// }

$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Changed 'quiz_id' to 'id'
$quiz = getQuizById($quiz_id);

if (!$quiz) {
    echo "Quiz not found.";
    exit();
}

$questions = getQuestionsByQuizId($quiz_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        $user_answer = isset($_POST['question_' . $question['id']]) ? $_POST['question_' . $question['id']] : '';
        if ($user_answer === $question['correct_answer']) {
            $score++;
        }
    }
    // Save the result only if the user is logged in
    if (isset($_SESSION['user_id'])) {
        saveResult($_SESSION['user_id'], $quiz_id, $score);
    }
    header('Location: result.php?score=' . $score);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($quiz['title']); ?> - QuizMaster</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
    /* Timer styles */
    .quiz-timer {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        position: sticky;
        top: 10px;
        z-index: 100;
    }

    .timer-container {
        display: flex;
        align-items: center;
    }

    .timer-icon {
        font-size: 24px;
        margin-right: 15px;
        color: #4a7eb3;
    }

    .timer-wrapper {
        flex-grow: 1;
    }

    .timer-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .timer-label {
        font-weight: 600;
        color: #555;
    }

    #timer-display {
        font-weight: 700;
        font-size: 18px;
        font-family: 'Courier New', monospace;
        transition: color 0.3s;
    }

    .timer-progress {
        height: 10px;
        border-radius: 5px;
        overflow: hidden;
        background-color: #e9ecef;
    }

    #timer-bar {
        height: 100%;
        background-color: #4a7eb3;
        transition: width 1s linear, background-color 0.5s;
    }

    /* Timer animation */
    @keyframes flash {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    .flash-timer {
        animation: flash 1s infinite;
    }

    /* Quiz completion animation */
    @keyframes countdown-complete {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .countdown-complete {
        animation: countdown-complete 0.5s;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-brain mr-2"></i>QuizMaster
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home mr-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-trophy mr-1"></i> Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <i class="fas fa-user mr-1"></i>
                            <?php echo isset($_SESSION['user_id']) ? 'Profile' : 'Login'; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Quiz Content -->
    <div class="container mt-5">
        <div class="quiz-container">
            <div class="quiz-header">
                <h1 class="quiz-title"><?php echo htmlspecialchars($quiz['title']); ?></h1>
                <div class="quiz-meta">
                    <span><i class="fas fa-question-circle mr-1"></i> <?php echo count($questions); ?> Questions</span>
                    <span><i class="fas fa-clock mr-1"></i> <?php echo htmlspecialchars($quiz['time_limit'] ?? '10'); ?>
                        Minutes</span>
                    <span class="difficulty <?php echo strtolower($quiz['difficulty'] ?? 'medium'); ?>">
                        <i class="fas fa-signal mr-1"></i>
                        <?php echo htmlspecialchars($quiz['difficulty'] ?? 'Medium'); ?>
                    </span>
                </div>
                <?php if (!empty($quiz['description'])): ?>
                <p class="quiz-description mt-3"><?php echo htmlspecialchars($quiz['description']); ?></p>
                <?php endif; ?>
            </div>

            <!-- Timer Section -->
            <div class="quiz-timer">
                <div class="timer-container">
                    <div class="timer-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="timer-wrapper">
                        <div class="timer-header">
                            <span class="timer-label">Time Remaining:</span>
                            <span
                                id="timer-display"><?php echo htmlspecialchars($quiz['time_limit'] ?? '10'); ?>:00</span>
                        </div>
                        <div class="timer-progress">
                            <div id="timer-bar" class="bg-info" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quiz-content mt-4">
                <form method="POST" id="quiz-form">
                    <?php $questionNumber = 1; ?>
                    <?php foreach ($questions as $question): ?>
                    <div class="question-card mb-4">
                        <div class="question-number">Question <?php echo $questionNumber++; ?></div>
                        <div class="question-text">
                            <h5><?php echo htmlspecialchars($question['question_text']); ?></h5>
                        </div>
                        <div class="answer-input mt-3">
                            <input type="text" name="question_<?php echo $question['id']; ?>" class="form-control"
                                placeholder="Your answer..." required>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="quiz-controls mt-4 mb-5">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Answers
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary ml-2">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-brain mr-2"></i>QuizMaster</h5>
                    <p>Expand your knowledge with interactive quizzes on various topics.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-angle-right mr-2"></i>About Us</a></li>
                        <li><a href="#"><i class="fas fa-angle-right mr-2"></i>Contact</a></li>
                        <li><a href="#"><i class="fas fa-angle-right mr-2"></i>Privacy Policy</a></li>
                        <li><a href="#"><i class="fas fa-angle-right mr-2"></i>Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect With Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> QuizMaster. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <script>
    // Timer functionality
    $(document).ready(function() {
        // Get time limit from PHP
        const timeLimit = <?php echo intval($quiz['time_limit'] ?? 10); ?>;
        let timeLeft = timeLimit * 60; // Convert to seconds
        const timerDisplay = $('#timer-display');
        const timerBar = $('#timer-bar');

        // Update timer every second
        const timerInterval = setInterval(function() {
            timeLeft--;

            // Update display
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.text(`${minutes}:${seconds.toString().padStart(2, '0')}`);

            // Update progress bar
            const percentLeft = (timeLeft / (timeLimit * 60)) * 100;
            timerBar.css('width', `${percentLeft}%`);

            // Warning colors
            if (percentLeft <= 25) {
                timerBar.removeClass('bg-warning').addClass('bg-danger');
                timerDisplay.addClass('text-danger font-weight-bold');
            } else if (percentLeft <= 50) {
                timerBar.removeClass('bg-info').addClass('bg-warning');
            }

            // Flash timer when less than 30 seconds
            if (timeLeft <= 30) {
                timerDisplay.toggleClass('flash-timer');
            }

            // Time's up
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                $('#quiz-form').submit(); // Auto-submit when time's up
            }
        }, 1000);
    });
    </script>
</body>

</html>