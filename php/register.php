<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .loading-container {
            display: none;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }
        .check {
            display: none;
            color: green;
            font-size: 150px;
            margin-top: 360px;
            margin-left: 890px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="loading-container">
    <div class="loading-spinner"></div>
    <div class="check">&#10003;</div>
</div>

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $agree_terms = isset($_POST["agree-terms"]) ? 1 : 0;

    // Insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, username, password, agree_terms)
            VALUES ('$first_name', '$last_name', '$email', '$username', '$password', $agree_terms)";

    if ($conn->query($sql) === TRUE) {
        // Display the loading animation and then morph into a check mark after 3 seconds
        echo "<script>
            $('.loading-container').show();
            setTimeout(function() {
                $('.loading-spinner').hide();
                $('.check').show();
            }, 3000);
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

</body>
</html>
