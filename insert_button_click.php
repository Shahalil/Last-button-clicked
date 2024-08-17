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
    if (isset($_POST['last_button'])) {
        $last_button = $_POST['last_button'];

        $stmt = $conn->query("SELECT * FROM button_data ORDER BY id DESC LIMIT 1;");

        if ($row = $stmt->fetch_assoc()) {
            echo $row["directions"] . " is the last button added";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
