<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "news";

$message = "";
$savedName = "";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$createTableSql = "CREATE TABLE IF NOT EXISTS user_names (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($createTableSql)) {
    die("Failed to create table: " . $conn->error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputName = isset($_POST["name"]) ? trim($_POST["name"]) : "";

    if ($inputName === "") {
        $message = "Please enter your name.";
    } else {
        $stmt = $conn->prepare("INSERT INTO user_names (name) VALUES (?)");

        if ($stmt) {
            $stmt->bind_param("s", $inputName);

            if ($stmt->execute()) {
                $savedName = htmlspecialchars($inputName, ENT_QUOTES, "UTF-8");
            } else {
                $message = "Failed to save name.";
            }

            $stmt->close();
        } else {
            $message = "Failed to prepare database query.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Test</title>
</head>
<body>
    <h2>Save Name Test</h2>

    <form method="POST" action="">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Save</button>
    </form>

    <?php if ($savedName !== ""): ?>
        <h3>Hello, <?php echo $savedName; ?></h3>
    <?php elseif ($message !== ""): ?>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></p>
    <?php endif; ?>
</body>
</html>