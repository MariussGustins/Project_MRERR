<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item = $_POST['item_name'];
$barcode_seller = $_POST['barcode_seller'];
$barcode_manufacter = $_POST['barcode_manufacter'];
$delivery_date_time = $_POST['dalivery_date_time'];
$delivery_contact_person = $_POST['dalivery_contact_person'];
$amount = $_POST['amount'];
$price = $_POST['price'];
$serial_nr = $_POST['serual_nr'];

$sql = "INSERT INTO items (item, barcode_seller, barcode_manufacter, delivery_date_time, dalivery_contact_person, amount, price, serial_nr) VALUES ('$item', '$barcode_seller', '$barcode_manufacter', '$delivery_date_time', '$delivery_contact_person', $amount, $price, '$serial_nr')";

if ($conn->query($sql) === TRUE) {
    echo "Item registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>