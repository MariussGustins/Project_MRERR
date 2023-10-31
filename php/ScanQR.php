<?php
// Include necessary libraries for reading QR codes and database operations

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['qr_code'])) {
    $qr_code = $_GET['qr_code'];

    // Read QR code to extract barcode data
    $decoded_data = "Barcode data extracted from the QR code"; // Use a QR code library to decode the data

    // Query the database using the extracted barcode
    $pdo = new PDO('mysql:host=localhost;dbname=project_mrderr', 'root', '');
    $stmt = $pdo->prepare("SELECT * FROM items WHERE barcode = ?");
    $stmt->execute([$decoded_data]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display data from the database
        echo "Barcode: " . $result['barcode'] . "<br>";
        echo "Item: " . $result['item_name'] . "<br>";
        echo "Date: " . $result['dateandtime'] . "<br>";
        echo "Contact Person: " . $result['delivery_contact_person'] . "<br>";
        echo "Amount: " . $result['amount'] . "<br>";
        echo "Price: " . $result['price'] . "<br>";
        echo "Serial Nr: " . $result['serial_nr'] . "<br>";
        echo "Manufacturer Barcode: " . $result['barcode_manufacturer'] . "<br>";
    } else {
        echo "Data not found.";
    }
}
?>
