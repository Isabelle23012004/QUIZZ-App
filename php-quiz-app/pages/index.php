<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

$quizzes = getQuizzes($conn, null); // Pass $conn as the first argument
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Interactive Learning Platform</title>
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
            <a class="navbar-brand" href="#">
                <i class="fas fa-brain mr-2"></i>QuizMaster
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fas fa-home mr-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-trophy mr-1"></i> Leaderboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="fas fa-user mr-1"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 hero-title">Challenge Your Knowledge</h1>
                    <p class="lead hero-subtitle">Test your skills with our interactive quizzes and compete with friends
                    </p>
                    <div class="search-box">
                        <input type="text" class="form-control" placeholder="Search quizzes...">
                        <button class="btn search-btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="../assets/images/WhiteLogo-removebg-preview.png" alt="Quiz illustration"
                        class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="container mt-5">
        <div class="section-header">
            <h2>Popular Categories</h2>
            <div class="section-line"></div>
        </div>
        <div class="row category-icons">
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <span>Tech</span>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <span>Science</span>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <span>History</span>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <span>Arts</span>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <span>Geography</span>
                </div>
            </div>
            <div class="col-4 col-md-2">
                <div class="category-item">
                    <div class="category-icon">
                        <i class="fas fa-football-ball"></i>
                    </div>
                    <span>Sports</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Quizzes -->
    <div class="container mt-5">
        <div class="section-header">
            <h2>Featured Quizzes</h2>
            <div class="section-line"></div>
        </div>
        <div class="row">
            <?php foreach ($quizzes as $quiz): ?>
            <div class="col-md-6 col-lg-4">
                <div class="quiz-card">
                    <div class="quiz-card-difficulty <?php echo strtolower($quiz['difficulty'] ?? 'medium'); ?>">
                        <?php echo htmlspecialchars($quiz['difficulty'] ?? 'Medium'); ?>
                    </div>
                    <div class="quiz-card-body">
                        <h5 class="quiz-card-title"><?php echo htmlspecialchars($quiz['title']); ?></h5>
                        <p class="quiz-card-text">
                            <?php echo htmlspecialchars($quiz['description'] ?? 'Test your knowledge with this exciting quiz!'); ?>
                        </p>
                        <div class="quiz-card-meta">
                            <span><i class="fas fa-question-circle"></i>
                                <?php echo htmlspecialchars($quiz['question_count'] ?? rand(5, 15)); ?> Questions</span>
                            <span><i class="fas fa-clock"></i>
                                <?php echo htmlspecialchars($quiz['time_limit'] ?? rand(5, 15)); ?> Minutes</span>
                        </div>
                    </div>
                    <div class="quiz-card-footer">
                        <a href="quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-start">
                            Start Quiz <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary btn-view-all">View All Quizzes</a>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3>Ready to create your own quiz?</h3>
                    <p>Share your knowledge and challenge others with your own customized quizzes.</p>
                </div>
                <div class="col-lg-4 text-lg-right">
                    <a href="#" class="btn btn-light btn-lg">Create Quiz <i class="fas fa-plus ml-2"></i></a>
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
    <script src="../assets/js/scripts.js"></script>
</body>

</html>