document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('signup-form'); // Updated form id
    const loadingDiv = document.getElementById('loading');

    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Display the loading animation
        registrationForm.style.display = 'none';
        loadingDiv.style.display = 'block';

        // Simulate a 3-second delay before redirecting
        setTimeout(function() {
            // Clear the page and redirect to LoginPage.html
            document.body.innerHTML = ''; // Clears the entire page
            window.location.href = 'LoginPage.html';
        }, 3000);
    });
});
