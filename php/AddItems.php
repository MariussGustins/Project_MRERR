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
    // Check if the array keys exist before accessing them
    if (isset($_POST["barcode"], $_POST["item_name"], $_POST["dateandtime"], $_POST["delivery_contact_person"], $_POST["amount"], $_POST["price"], $_POST["serial_nr"], $_POST["barcode_manufacturer"])) {
        $barcode = $_POST["barcode"];
        $item_name = $_POST["item_name"];
        $dateandtime = $_POST["dateandtime"];
        $delivery_contact_person = $_POST["delivery_contact_person"];
        $amount = $_POST["amount"];
        $price = $_POST["price"];
        $serial_nr = $_POST["serial_nr"];
        $barcode_manufacturer = $_POST["barcode_manufacturer"];

        // Insert data into the database
        $sql = "INSERT INTO items (barcode, item_name, dateandtime, delivery_contact_person, amount, price, serial_nr, barcode_manufacturer)
                VALUES ('$barcode', '$item_name', '$dateandtime', '$delivery_contact_person', '$amount', '$price', '$serial_nr', '$barcode_manufacturer')";

        if ($conn->query($sql) === TRUE) {
            echo "Added successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "One or more form fields are missing.";
    }
}

// Close the database connection
$conn->close();
?>
