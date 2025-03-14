<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <header>
        <h1>Welcome to My PHP MVC Application</h1>
    </header>
    <main>
        <h2>Home</h2>
        <p>This is the home page of the application.</p>
        <?php if (isset($data)): ?>
            <h3>Data:</h3>
            <ul>
                <?php foreach ($data as $item): ?>
                    <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No data available.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> My PHP MVC Application</p>
    </footer>
</body>
</html>