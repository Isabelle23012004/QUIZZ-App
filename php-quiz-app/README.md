# PHP Quiz Application

## Overview
This PHP Quiz Application allows users to take quizzes, view their scores, and for administrators to manage quizzes and questions. The application uses MySQL as the database management system and features a modern frontend built with Bootstrap.

## Features
- User registration and login
- Multiple quizzes with various questions
- Score calculation and result display
- Admin panel for managing quizzes and questions
- Responsive design using Bootstrap

## Project Structure
```
php-quiz-app
├── assets
│   ├── css
│   │   └── styles.css
│   └── js
│       └── scripts.js
├── db
│   └── schema.sql
├── includes
│   ├── db_connect.php
│   └── functions.php
├── pages
│   ├── index.php
│   ├── quiz.php
│   ├── result.php
│   └── admin.php
├── README.md
└── .gitignore
```

## Database Schema
The database schema is defined in `db/schema.sql` and includes the following tables:

- **users**
  - id (INT, PRIMARY KEY)
  - username (VARCHAR)
  - password (VARCHAR)

- **quizzes**
  - id (INT, PRIMARY KEY)
  - title (VARCHAR)
  - created_at (DATETIME)

- **questions**
  - id (INT, PRIMARY KEY)
  - quiz_id (INT, FOREIGN KEY)
  - question_text (TEXT)
  - correct_answer (VARCHAR)

- **results**
  - id (INT, PRIMARY KEY)
  - user_id (INT, FOREIGN KEY)
  - quiz_id (INT, FOREIGN KEY)
  - score (INT)
  - created_at (DATETIME)

## Setup Instructions
1. Clone the repository to your local machine.
2. Import the database schema from `db/schema.sql` into your MySQL database.
3. Configure the database connection in `includes/db_connect.php`.
4. Open `pages/index.php` in your web browser to access the application.

## Usage
- Users can register and log in to take quizzes.
- After completing a quiz, users can view their scores on the results page.
- Administrators can manage quizzes and questions through the admin panel.

## Technologies Used
- PHP
- MySQL
- Bootstrap (for frontend design)
- JavaScript (for interactivity)

## License
This project is open-source and available for modification and distribution.