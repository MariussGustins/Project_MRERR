<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_mrderr";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for item removal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the array keys exist before accessing them
    if (isset($_POST["item_to_remove"])) {
        $item_to_remove = $_POST["item_to_remove"];

        // Remove the item from the database based on item name or barcode
        $sql = "DELETE FROM items WHERE item_name = '$item_to_remove' OR barcode = '$item_to_remove'";

        if ($conn->query($sql) === TRUE) {
            echo "Item removed successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Item to remove is missing.";
    }
}

// Close the database connection
$conn->close();
?>


