
//Add button
document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var add_btn = document.getElementById("add_btn");

    // Add a click event listener to the button
    add_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("add button works ;) new css");
    });
    add_btn.addEventListener("click", function (){
        window.location.href = "../html/AddItems.html";
    });
});


//Delete Button
document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var delete_btn = document.getElementById("delete_btn");

    // Add a click event listener to the button
    delete_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("delete button works ;) new css");
    });
    delete_btn.addEventListener("click", function (){
        window.location.href = "../html/index.html";
    });

//Search Button
});document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var search_btn = document.getElementById("search_btn");

    // Add a click event listener to the button
    search_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("search button works ;) new css");
    });
});
//Scan Button
document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var scan_btn = document.getElementById("scan_btn");

    // Add a click event listener to the button
    scan_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("scan button works ;) new css");
    });
    scan_btn.addEventListener("click", function (){
        window.location.href = "../html/indexQR.html";
    });
});

function searchItems() {
    const searchInput = document.getElementById('search').value;
    const itemRows = document.querySelectorAll('.item-row');

    itemRows.forEach(row => {
        const itemText = row.textContent || row.innerText;
        if (itemText.includes(searchInput)) {
            row.style.backgroundColor = 'yellow'; // Highlight the row
            setTimeout(() => {
                row.style.backgroundColor = ''; // Remove the highlight after 3 seconds
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    });
}

function handleSearchKeyPress(event) {
    if (event.key === 'Enter') {
        searchItems();
    }
}