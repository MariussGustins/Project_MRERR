<?php
// Connect to the database (replace with your database credentials)
$db = new mysqli('localhost', 'root', '', 'project_mrderr');

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Retrieve the itemId from the POST data
$data = json_decode(file_get_contents('php://input'));
$itemId = $data->itemId;

// Fetch item details from the database
$query = "SELECT * FROM items WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $itemId);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Return item details as JSON
        echo json_encode($row);
    } else {
        echo "Item not found";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$db->close();
