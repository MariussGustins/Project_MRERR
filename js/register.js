document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('signup-form');
    const loadingDiv = document.getElementById('loading');

    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        registrationForm.style.display = 'none';
        loadingDiv.style.display = 'block';

        setTimeout(function() {
            document.body.innerHTML = '';
            window.location.href = 'LoginPage.html';
        }, 3000);
    });
});
