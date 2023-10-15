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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verify the username and password against the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Successful login - Redirect to a new page
            header("Location: /Project_MRERR/php/HomePage.php");
            exit(); // Make sure to exit to prevent further code execution

            // Insert successful login attempt into the login_attempts table
            $insertSql = "INSERT INTO login_attempts (username, password) VALUES ('$username', '$password')";
            if ($conn->query($insertSql) === TRUE) {
                // You can perform additional actions here if needed
            } else {
                echo "Error recording login attempt: " . $conn->error;
            }
        } else {
            $errorMessage = "Invalid password.";
            echo "<p style='color: red; font-weight: bold;'>$errorMessage</p>";
        }
    } else {
        echo "Username not found.";
    }
}

// Close the database connection
$conn->close();
?>