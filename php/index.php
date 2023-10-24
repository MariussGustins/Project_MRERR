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
    if (isset($_POST["item_name"], $_POST["serial_nr"], $_POST["amount"])) {
        $item_name = $_POST["item_name"];
        $serial_nr = $_POST["serial_nr"];
        $amount_removed = intval($_POST["amount"]);
        // Retrieve the original_item_id from the items table
        $retrieve_original_id_sql = "SELECT id FROM items WHERE item_name = '$item_name' AND serial_nr = '$serial_nr'";
        $result = $conn->query($retrieve_original_id_sql);

        // Check if the item exists in the inventory
        $check_inventory_sql = "SELECT * FROM items WHERE item_name = '$item_name' AND serial_nr = '$serial_nr'";
        $inventory_result = $conn->query($check_inventory_sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $original_item_id = $row['id'];

        if ($inventory_result && $inventory_result->num_rows > 0) {
            // Item found in inventory
            $row = $inventory_result->fetch_assoc();
            $available_amount = intval($row['amount']);
            $price = floatval($row['price']);
            $total_price = $price * $amount_removed;

            if ($amount_removed <= $available_amount) {
                // Sufficient quantity available for removal
                // Update the inventory
                $new_amount = $available_amount - $amount_removed;
                $update_sql = "UPDATE items SET amount = $new_amount WHERE item_name = '$item_name' AND serial_nr = '$serial_nr'";
                $conn->query($update_sql);

                // Insert removed item data into the removed_items table
                $dateandtime = date('Y-m-d H:i:s');
                $delivery_contact_person = $row['delivery_contact_person'];
                $barcode_manufacturer = $row['barcode_manufacturer'];

                $insert_removed_item_sql = "INSERT INTO removed_items (barcode, item_name, dateandtime, delivery_contact_person, amount, price, serial_nr, barcode_manufacturer, total_price, original_item_id)
                    VALUES ('{$row['barcode']}', '$item_name', '$dateandtime', '$delivery_contact_person', $amount_removed, $price, '$serial_nr', '$barcode_manufacturer', $total_price, $original_item_id)";

                if ($conn->query($insert_removed_item_sql) === TRUE) {
                    echo "Removed $amount_removed items of $item_name successfully! Total Price: $total_price";
                } else {
                    echo "Error inserting into removed_items: " . $conn->error;
                }
            } else {
                echo "In inventory, only $available_amount left for $item_name.";
            }
        } else {
            echo "Item $item_name with serial number $serial_nr not found in inventory.";
        }
    } else {
            echo "One or more form fields are missing.";
        }
    }
}

// Close the database connection
$conn->close();
?>
