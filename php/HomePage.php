<?php
// Connection to the database
$db = new mysqli('localhost', 'root', '', 'project_mrderr');

// Number of rows to display per page
$itemsPerPage = 12;

// Get the current page number from the URL
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}
// Get the search input from the POST request
$searchInput = isset($_POST['searchInput']) ? $db->real_escape_string($_POST['searchInput']) : '';
// Calculate the LIMIT and OFFSET values for SQL query
$offset = ($currentPage - 1) * $itemsPerPage;
// Database query with LIMIT and OFFSET, and filtered by search input
$query = "SELECT * FROM items WHERE item_name LIKE '%$searchInput%' LIMIT $itemsPerPage OFFSET $offset";
// Database query with LIMIT and OFFSET
$query = "SELECT * FROM items LIMIT $itemsPerPage OFFSET $offset";
$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/HomePage.css" />
    <script src="../js/HomePage.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
</head>
<body>
<div class="home-page">
    <div class="home-page-child"></div>
    <div class="home-page-child19">
        <button type="button" id="add_btn"></button>
    </div>

    <div class="home-page-child20">
        <button type="button" id="delete_btn"></button>
    </div>
    <div class="home-page-child21">
        <button type="button" id="search_btn" onclick="searchItems()"></button>
    </div>
    <div class="home-page-child22">
        <button type="button" id="scan_btn"></button>
    </div>
    <div class="home-page-child23">
        <input type="text" id="search" name="search" placeholder="Search..." onkeypress="handleSearchKeyPress(event)">
    </div>
    <div class="div">+</div>
    <img class="image-2-icon" alt="" src="../public/magnify-1.1s-200px%20(1).svg" />

    <img
            class="trash-can-11s-200px-1"
            alt=""
            src="../public/trash%20can-1.1s-200px.svg"
    />

    <img
            class="barcode-100s-19px-2-icon"
            alt=""
            src="../public/barcode-100s-19px.svg"
    />

    <div class="items-table">
        <div style="max-height: 400px; overflow: auto;">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Barcode</th>
                    <th>Date and time</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $amount = $row['amount'];
                    $rowStyle = ($amount == 0) ? 'background-color: red; color: white;' : '';
                    echo "<tr style='$rowStyle' class='item-row' data-id='" . $row['id'] . "'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['barcode'] . "</td>";
                    echo "<td>" . $row['dateandtime'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Pagination controls -->
    <div class="pagination">
        <?php
        // Calculate the total number of rows (without closing the connection)
        $query = "SELECT COUNT(*) AS total_rows FROM items";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $totalRows = $row['total_rows'];
        $totalPages = ceil($totalRows / $itemsPerPage);

        // Display previous page link
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "'>Previous</a> ";
        }

        // Display page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }

        // Display next page link
        if ($currentPage < $totalPages) {
            echo "<a href='?page=" . ($currentPage + 1) . "'>Next</a>";
        }

        // Close the database connection after using it
        $db->close();
        ?>
    </div>
    <script>
        const itemRows = document.querySelectorAll('.item-row');

        itemRows.forEach(row => {
            row.addEventListener('click', () => {
                // Get the data-id attribute to identify the item
                const itemId = row.getAttribute('data-id');

                // Function to show item details when a row is clicked
                function showItemDetails(itemId) {
                    // Make an AJAX request to get item details
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'get_item_details.php');
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            // Parse the JSON response
                            const itemDetails = JSON.parse(xhr.responseText);

                            // Display item details in a pop-up or alert
                            alert(`Item ID: ${itemDetails.id}\nItem Name: ${itemDetails.item_name}\nBarcode: ${itemDetails.barcode}\nDate and Time: ${itemDetails.dateandtime}\nDelivery Contact Person: ${itemDetails.delivery_contact_person}\nAmount:${itemDetails.amount}\nPrice:${itemDetails.price}\nSerial Nr.:${itemDetails.serial_nr}\nBarcode Manufacturer:${itemDetails.barcode_manufacturer}`);
                        } else {
                            alert('Failed to retrieve item details.');
                        }
                    };

                    // Send the itemId in the request body
                    xhr.send(JSON.stringify({ itemId }));
                }

                showItemDetails(itemId);
            });
        });

    </script>

</body>
</html>






