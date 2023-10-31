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

// Check if the user is logged in (assuming user_id is set in the session)
if (isset($_SESSION['user_id'])) {
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
            $user_id = $_SESSION['user_id']; // Store the user_id in a variable

            // Check if the item already exists in the database
            $sql_check = "SELECT * FROM items WHERE barcode = ? AND item_name = ? AND serial_nr = ? AND barcode_manufacturer = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ssss", $barcode, $item_name, $serial_nr, $barcode_manufacturer);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                // Item already exists, update the amount, price, and delivery_contact_person
                $existingItem = $result_check->fetch_assoc();
                $updatedAmount = $existingItem['amount'] + $amount;
                $updatedDeliveryContactPerson = $existingItem['delivery_contact_person'] . ', ' . $delivery_contact_person;
                $sql_update = "UPDATE items SET amount = ?, price = ?, delivery_contact_person = ? WHERE barcode = ? AND item_name = ? AND serial_nr = ? AND barcode_manufacturer = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("dssssss", $updatedAmount, $price, $updatedDeliveryContactPerson, $barcode, $item_name, $serial_nr, $barcode_manufacturer);

                // Generate a QR code using the barcode and save it as an image
                $data = "Barcode: $barcode\nItem: $item_name\nDate: $dateandtime\nContact Person: $delivery_contact_person\nAmount: $amount\nPrice: $price\nSerial Nr: $serial_nr\nManufacturer Barcode: $barcode_manufacturer";
                $qr = new Endroid\QrCode\QrCode($data);
                $qr->writeFile("qr_codes/$barcode.png");

                if ($stmt_update->execute()) {
                    echo "Item already exists. Amount, price, and delivery contact person updated successfully!";
                } else {
                    echo "Error updating the item: " . $conn->error;
                }

                $stmt_update->close();
            } else {
                // Item doesn't exist, insert a new one
                $sql_insert = "INSERT INTO items (barcode, item_name, dateandtime, delivery_contact_person, amount, price, serial_nr, barcode_manufacturer, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ssssddssd", $barcode, $item_name, $dateandtime, $delivery_contact_person, $amount, $price, $serial_nr, $barcode_manufacturer, $user_id);

                if ($stmt_insert->execute()) {
                    echo "Added successfully!";
                } else {
                    echo "Error inserting the item: " . $conn->error;
                }

                $stmt_insert->close();
            }

            $stmt_check->close();
        } else {
            echo "One or more form fields are missing.";
        }
    }
} else {
    echo "User is not logged in."; // Handle the case when the user is not logged in
}

// Close the database connection
$conn->close();
