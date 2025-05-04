<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        include '../app/Views/home.php';
    }

    public function quiz() {
        include '../app/Views/quiz.php'; // Render the quiz page
    }

    public function submitQuiz() {
        // Handle quiz submission logic here
        echo "Quiz submitted!";
    }
}