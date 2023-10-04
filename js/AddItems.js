//LogIn button
document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var add = document.getElementById("add");

    // Add a click event listener to the button
    add.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("login button works ;) new css");
    });
});
//Scan Button
document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var barcode_btn = document.getElementById("barcode_btn");

    // Add a click event listener to the button
    barcode_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("barcode button works ;) new css");
    });
    barcode_btn.addEventListener("click", function (){
        window.location.href = "indexQR.html";
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get a reference to the button element
    var qr_btn = document.getElementById("qr_btn");

    // Add a click event listener to the button
    qr_btn.addEventListener("click", function() {
        // Display a message in the console when the button is clicked
        console.log("qr button works ;) new css");
    });
    qr_btn.addEventListener("click", function (){
        window.location.href = "indexQR.html";
    });
});
