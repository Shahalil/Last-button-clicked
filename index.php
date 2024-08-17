<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Layout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP is empty
$dbname = "button_clicks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['directions'])) {
        $directions = $_POST['directions'];

        $stmt = $conn->prepare("INSERT INTO button_data (directions) VALUES (?)");
        $stmt->bind_param("s", $directions);

        if ($stmt->execute()) {
            echo "$directions is added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>


    <div class="container">
        <form action="index.php" method="POST">
            <input type="hidden" name="directions" value="Forward">
            <button type="submit">Forward</button>
        </form>
        <div class="middle-buttons">
            <form action="index.php" method="POST">
                <input type="hidden" name="directions" value="Left">
                <button type="submit">Left</button>
            </form>
            <form action="index.php" method="POST">
                <input type="hidden" name="directions" value="Stop">
                <button type="submit">Stop</button>
            </form>
            <form action="index.php" method="POST">
                <input type="hidden" name="directions" value="Right">
                <button type="submit">Right</button>
            </form>
        </div>
        <div class="spacer"></div>
        <form action="index.php" method="POST">
            <input type="hidden" name="directions" value="Backward">
            <button type="submit">Backward</button>
        </form>
        <div>
        <form action="insert_button_click.php" method="POST">
            <input type="hidden" name="last_button" value="last_button">
            <button type="submit">View Last Button</button>
        </form>

        </div>
    </div>

</body>
</html>
