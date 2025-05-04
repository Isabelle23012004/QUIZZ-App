<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZZ App - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --primary-color: #6366F1;
        --secondary-color: #4F46E5;
        --accent-color: #10B981;
        --background-color: #F9FAFB;
        --text-color: #1F2937;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        line-height: 1.6;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 5rem 1rem;
        border-radius: 0 0 2rem 2rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .hero-title {
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -0.025em;
    }

    .hero-subtitle {
        opacity: 0.9;
        max-width: 600px;
        margin: 1rem auto;
        font-size: 1.2rem;
    }

    .content-card {
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
        margin-top: -3rem;
        max-width: 800px;
    }

    .btn-start {
        background-color: var(--accent-color);
        border: none;
        padding: 0.8rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-start:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        background-color: #0DA271;
    }

    .btn-start i {
        margin-left: 8px;
    }

    .feature-box {
        padding: 1.5rem;
        border-radius: 0.8rem;
        margin-bottom: 1rem;
        background-color: #F3F4F6;
        transition: transform 0.2s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    footer {
        background-color: #F3F4F6;
        border-top: 1px solid #E5E7EB;
        padding: 1.5rem 0;
        margin-top: 5rem;
    }
    </style>
</head>

<body>
    <header class="hero-section text-white text-center">
        <div class="container">
            <h1 class="hero-title">QUIZZ App</h1>
            <p class="hero-subtitle">Challenge your knowledge with fun and engaging quizzes designed to test your
                limits!</p>
        </div>
    </header>

    <main class="container">
        <div class="content-card mx-auto text-center">
            <h2 class="mb-4 fw-bold">Ready to test your knowledge?</h2>
            <p class="mb-5">Jump into our interactive quizzes and discover how much you really know. Perfect for
                learning new things or competing with friends!</p>

            <a href="/start-quiz" class="btn btn-start btn-lg">
                Start Quiz <i class="fas fa-arrow-right"></i>
            </a>

            <div class="row mt-5 pt-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Quick & Fun</h4>
                        <p>Short quizzes that keep you engaged</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Learn as You Go</h4>
                        <p>Expand your knowledge with every question</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h4>Track Progress</h4>
                        <p>See your improvement over time</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; <script>
                document.write(new Date().getFullYear())
                </script> QUIZZ App. All rights reserved.</p>
            <div class="mt-2">
                <a href="/admin" class="admin-link">Admin Portal <i class="fas fa-lock"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>