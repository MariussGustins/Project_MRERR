<?php
//connection to database
$db = new mysqli('localhost', 'root', '', 'project_mrderr');

//database query
$query = "SELECT * FROM items";

$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/HomePage.css" />
    <script src="./js/HomePage.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
</head>
<body>
<div class="home-page">
    <div class="home-page-child"></div>
    <div class="home-page-item"></div>
    <div class="home-page-inner"></div>
    <div class="home-page-child1"></div>
    <div class="home-page-child2"></div>
    <div class="home-page-child3"></div>
    <div class="home-page-child4"></div>
    <div class="home-page-child5"></div>
    <div class="home-page-child6"></div>
    <div class="home-page-child7"></div>
    <div class="home-page-child8"></div>
    <div class="home-page-child9"></div>
    <div class="home-page-child10"></div>
    <div class="home-page-child11"></div>
    <div class="home-page-child12"></div>
    <div class="home-page-child13"></div>
    <div class="home-page-child14"></div>
    <div class="home-page-child14"></div>
    <div class="home-page-child16"></div>
    <div class="home-page-child17"></div>
    <div class="home-page-child18"></div>
    <div class="home-page-child19">
        <button type="button" id="add_btn"></button>
    </div>

    <div class="home-page-child20">
        <button type="button" id="delete_btn"></button>
    </div>
    <div class="home-page-child21">
        <button type="button" id="search_btn"></button>
    </div>
    <div class="home-page-child22">
        <button type="button" id="scan_btn"></button>
    </div>
    <div class="home-page-child23">
        <input type="text" id="search" name="search" placeholder="Search...">
    </div>
    <div class="div">+</div>
    <img class="image-2-icon" alt="" src="./public/magnify-1.1s-200px%20(1).svg" />

    <div class="id">ID</div>
    <div class="item2">Item</div>
    <div class="barcode">Barcode</div>
    <div class="date-and-time">Date and time</div>
    <div class="items-table">Items table</div>
    <img
            class="trash-can-11s-200px-1"
            alt=""
            src="./public/trash%20can-1.1s-200px.svg"
    />

    <img
            class="barcode-100s-19px-2-icon"
            alt=""
            src="./public/barcode-100s-19px.svg"
    />

    <div class="items-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Barcode</th>
                <th>Date and time</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['barcode'] . "</td>";
                echo "<td>" . $row['dateandtime'] . "</td>";
                echo "</tr>";
            }
            $db->close();
            ?>
        </table>
    </div>
</div>
</body>
</html>
