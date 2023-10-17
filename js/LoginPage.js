//SignUp button
document.addEventListener("DOMContentLoaded", function () {
    // Get a reference to the button element
    var signup = document.getElementById("signup");

    // Add a click event listener to the button
    signup.addEventListener("click", function () {
        // Display a message in the console when the button is clicked
        console.log("signup button works ;) new css");
    });

    signup.addEventListener("click", function () {
        window.location.href = "../html/Register.html";
    });
});

//LogIn button
document.addEventListener("DOMContentLoaded", function () {
    // Get a reference to the button element
    var login = document.getElementById("login");

    // Add a click event listener to the button
    login.addEventListener("click", function () {
        // Display a message in the console when the button is clicked
        console.log("login button works ;) new css");
    });
});
// document.addEventListener('DOMContentLoaded', function () {
//     // Check for the presence of the 'error' query parameter
//     const urlParams = new URLSearchParams(window.location.search);
//     if (urlParams.get('error') === 'password') {
//         // Show the popup with the error message
//         const popup = document.getElementById('popup');
//         popup.style.display = 'block';
//
//         // Hide the popup after a few seconds (e.g., 5 seconds)
//         setTimeout(function () {
//             popup.style.display = 'none';
//         }, 3000);
//     }
//
//     // Add an event listener to the login form
//     const loginForm = document.getElementById('login-form');
//     loginForm.addEventListener('submit', function (event) {
//         // Check for invalid password condition here
//         // You should implement this check in your PHP code
//         // If the password is invalid, you can set the 'error' query parameter
//         // and redirect to LoginPage.html with the error parameter
//         const isInvalidPassword = true; // Replace this with your validation logic
//         if (isInvalidPassword) {
//             event.preventDefault(); // Prevent the form submission
//             window.location.href = '/Project_MRERR/LoginPage.html?error=password';
//         }
//     });
// });