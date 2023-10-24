<?php
session_start();
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
        $user_id = $row["id"];
        $SESSION['user_id']= $user_id;
        if (password_verify($password, $row["password"])) {
            // Insert a successful login attempt into the login_attempts table
            $insertSql = "INSERT INTO login_attempts (username, password, status,user_id) VALUES ('$username', '$password', 'success', $user_id)";
            if ($conn->query($insertSql) === TRUE) {
                // Successful login - Redirect to a new page
                header("Location: /Project_MRERR/php/HomePage.php");
                exit(); // Make sure to exit to prevent further code execution
            } else {
                echo "Error recording login attempt: " . $conn->error;
            }
        } else {
            // Insert a failed login attempt into the login_attempts table
            $insertSql = "INSERT INTO login_attempts (username, password, status,user_id) VALUES ('$username', '$password', 'failure', NULL)";
            if ($conn->query($insertSql) === TRUE) {
                $errorMessage = "Invalid password.";
                echo "<p style='color: red; font-weight: bold;'>$errorMessage</p>";
            } else {
                echo "Error recording login attempt: " . $conn->error;
            }
        }
    } else {
        echo "Username not found.";
    }
}

// Close the database connection
$conn->close();
?>
