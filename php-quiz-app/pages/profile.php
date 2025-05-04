<?php
session_start();
include '../includes/db_connect.php';
include '../includes/functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Capture the current page URL
    $redirectUrl = urlencode($_SERVER['REQUEST_URI']);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuizMaster</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.php"><i class="fas fa-user mr-1"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-card">
                        <div class="auth-header">
                            <div class="auth-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h2>Welcome Back</h2>
                            <p>Sign in to continue to QuizMaster</p>
                        </div>

                        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i> Invalid username or password.
                        </div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <input type="hidden" name="redirect" value="<?php echo $redirectUrl; ?>">
                            <div class="form-group">
                                <label for="username"><i class="fas fa-user mr-2"></i>Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fas fa-key mr-2"></i>Password</label>
                                <div class="password-field">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required>
                                    <span class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="custom-control-label" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="forgot-link">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </button>
                        </form>

                        <div class="auth-footer">
                            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                            <div class="social-login">
                                <p>Or login with</p>
                                <div class="social-icons">
                                    <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>

</html>
<?php
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// Fetch user's quiz statistics
$stmt = $conn->prepare("
    SELECT 
        COUNT(DISTINCT quiz_id) as quizzes_taken,
        SUM(score) as total_score,
        ROUND(AVG(score), 1) as average_score,
        MAX(score) as highest_score
    FROM quiz_attempts 
    WHERE user_id = :user_id
");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

// If no stats available, initialize with zeros
if (!$stats) {
    $stats = [
        'quizzes_taken' => 0,
        'total_score' => 0,
        'average_score' => 0,
        'highest_score' => 0
    ];
}

// Get recent quiz attempts
$stmt = $conn->prepare("
    SELECT qa.*, q.title as quiz_title
    FROM quiz_attempts qa
    JOIN quizzes q ON qa.quiz_id = q.id
    WHERE qa.user_id = :user_id
    ORDER BY qa.created_at DESC
    LIMIT 5
");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$recent_attempts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - QuizMaster</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.php"><i class="fas fa-user mr-1"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Hero -->
    <div class="profile-hero">
        <div class="container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php 
                    // Get first letter of username for avatar
                    $firstLetter = strtoupper(substr($user['username'], 0, 1));
                    echo $firstLetter;
                    ?>
                </div>
                <div class="profile-info">
                    <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                    <p><i
                            class="fas fa-envelope mr-2"></i><?php echo htmlspecialchars($user['email'] ?? 'No email provided'); ?>
                    </p>
                    <p><i class="fas fa-calendar-alt mr-2"></i>Member since
                        <?php echo date('F d, Y', strtotime($user['created_at'])); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container profile-container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="profile-sidebar">
                    <div class="profile-menu">
                        <a href="#dashboard" class="active"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                        <a href="#stats"><i class="fas fa-chart-line mr-2"></i>Statistics</a>
                        <a href="#activity"><i class="fas fa-history mr-2"></i>Recent Activity</a>
                        <a href="#settings"><i class="fas fa-cog mr-2"></i>Settings</a>
                        <a href="logout.php" class="logout-link"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Stats Cards -->
                <div id="dashboard" class="profile-section">
                    <h3 class="section-title">Your Quiz Performance</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon blue">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $stats['quizzes_taken']; ?></h4>
                                    <p>Quizzes Taken</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon green">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $stats['total_score']; ?></h4>
                                    <p>Total Points</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon purple">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $stats['average_score']; ?>%</h4>
                                    <p>Average Score</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon orange">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="stat-info">
                                    <h4><?php echo $stats['highest_score']; ?>%</h4>
                                    <p>Highest Score</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div id="activity" class="profile-section">
                    <h3 class="section-title">Recent Quiz Activity</h3>
                    <?php if (count($recent_attempts) > 0): ?>
                    <div class="activity-list">
                        <?php foreach ($recent_attempts as $attempt): ?>
                        <div class="activity-item">
                            <div
                                class="activity-icon <?php echo ($attempt['score'] >= 70) ? 'green' : (($attempt['score'] >= 50) ? 'orange' : 'red'); ?>">
                                <i
                                    class="fas <?php echo ($attempt['score'] >= 70) ? 'fa-check-circle' : (($attempt['score'] >= 50) ? 'fa-exclamation-circle' : 'fa-times-circle'); ?>"></i>
                            </div>
                            <div class="activity-details">
                                <h5><?php echo htmlspecialchars($attempt['quiz_title']); ?></h5>
                                <div class="activity-meta">
                                    <span><i class="fas fa-calendar-day mr-1"></i>
                                        <?php echo date('M d, Y', strtotime($attempt['created_at'])); ?></span>
                                    <span><i class="fas fa-clock mr-1"></i>
                                        <?php echo date('h:i A', strtotime($attempt['created_at'])); ?></span>
                                    <span
                                        class="score <?php echo ($attempt['score'] >= 70) ? 'text-success' : (($attempt['score'] >= 50) ? 'text-warning' : 'text-danger'); ?>">
                                        <i class="fas fa-percentage mr-1"></i> <?php echo $attempt['score']; ?>%
                                    </span>
                                </div>
                            </div>
                            <a href="quiz_results.php?attempt_id=<?php echo $attempt['id']; ?>"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye mr-1"></i> View Details
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="all_attempts.php" class="btn btn-outline-primary btn-view-all mt-3">
                        <i class="fas fa-history mr-1"></i> View All Activity
                    </a>
                    <?php else: ?>
                    <div class="no-data">
                        <div class="no-data-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4>No Quizzes Taken Yet</h4>
                        <p>You haven't completed any quizzes yet. Start your learning journey!</p>
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-play mr-1"></i> Take a Quiz
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Recommended Quizzes -->
                <div class="profile-section">
                    <h3 class="section-title">Recommended for You</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="quiz-card">
                                <div class="quiz-card-difficulty medium">Medium</div>
                                <div class="quiz-card-body">
                                    <h5 class="quiz-card-title">Advanced Mathematics</h5>
                                    <p class="quiz-card-text">Test your knowledge of calculus and algebra.</p>
                                    <div class="quiz-card-meta">
                                        <span><i class="fas fa-question-circle"></i> 15 Questions</span>
                                        <span><i class="fas fa-clock"></i> 15 Minutes</span>
                                    </div>
                                </div>
                                <div class="quiz-card-footer">
                                    <a href="quiz.php?id=1" class="btn btn-start">
                                        Start Quiz <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="quiz-card">
                                <div class="quiz-card-difficulty easy">Easy</div>
                                <div class="quiz-card-body">
                                    <h5 class="quiz-card-title">World Geography</h5>
                                    <p class="quiz-card-text">Explore countries, capitals, and landmarks.</p>
                                    <div class="quiz-card-meta">
                                        <span><i class="fas fa-question-circle"></i> 10 Questions</span>
                                        <span><i class="fas fa-clock"></i> 10 Minutes</span>
                                    </div>
                                </div>
                                <div class="quiz-card-footer">
                                    <a href="quiz.php?id=2" class="btn btn-start">
                                        Start Quiz <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>

</html>