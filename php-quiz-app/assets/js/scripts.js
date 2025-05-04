// This file contains JavaScript functionality for the quiz application, including handling user interactions and AJAX requests.

document.addEventListener('DOMContentLoaded', function() {
    const quizForm = document.getElementById('quiz-form');
    const resultContainer = document.getElementById('result-container');

    if (quizForm) {
        quizForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(quizForm);
            fetch('includes/submit_quiz.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayResult(data.score);
                } else {
                    alert('Error submitting quiz. Please try again.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    function displayResult(score) {
        resultContainer.innerHTML = `<h2>Your Score: ${score}</h2>`;
        resultContainer.style.display = 'block';
    }
});