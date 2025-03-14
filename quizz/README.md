# My PHP MVC Application

This is a simple PHP application structured using the Model-View-Controller (MVC) design pattern. The application serves as a basic example of how to implement MVC in PHP.

## Project Structure

```
quizz
├── app
│   ├── Controllers
│   │   └── HomeController.php
│   ├── Models
│   │   └── HomeModel.php
│   ├── Views
│       └── home.php
├── public
│   └── index.php
├── config
│   └── config.php
├── vendor
├── composer.json
└── README.md
```

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd my-php-mvc-app
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage

1. Start a local server (e.g., using PHP's built-in server):
   ```
   php -S localhost:8000 -t public
   ```

2. Open your web browser and go to `http://localhost:8000` to view the application.

## Features

- **MVC Structure**: The application is organized into Controllers, Models, and Views.
- **Routing**: The entry point is `public/index.php`, which handles routing to the appropriate controller.
- **Data Handling**: The `HomeModel` class manages data retrieval and manipulation.

## Contributing

Feel free to submit issues or pull requests for improvements or bug fixes. 

## License

This project is open-source and available under the MIT License.