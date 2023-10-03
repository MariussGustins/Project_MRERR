<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_mrderr";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item1'];
    $barcode_seller = $_POST['barcode'];
    $barcode_manufacturer = $_POST['barcode(manu)'];
    $delivery_date_time = $_POST['dateandtime'];
    $delivery_contact_person = $_POST['delivery-contact-person'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $serial_nr = $_POST['Serial'];

    $sql = "INSERT INTO items (item, barcode_seller, barcode_manufacturer, delivery_date_time, delivery_contact_person, amount, price, serial_nr)
            VALUES ('$item', '$barcode_seller', '$barcode_manufacturer', '$delivery_date_time', '$delivery_contact_person', $amount, $price, '$serial_nr')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Item registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>