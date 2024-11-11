document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const rememberMe = document.getElementById('rememberMe');

    // Load saved email from localStorage
    if (localStorage.getItem('savedEmail')) {
        emailInput.value = localStorage.getItem('savedEmail');
        rememberMe.checked = true;
    }

    // Form validation
    registerForm.addEventListener('submit', function (event) {
        let isValid = true;

        // Validate email format
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            emailError.textContent = 'Please enter a valid email address.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validate password length
        if (passwordInput.value.length < 8) {
            passwordError.textContent = 'Password must be at least 8 characters long.';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        // Save email to localStorage if "Remember Me" is checked
        if (rememberMe.checked) {
            localStorage.setItem('savedEmail', emailInput.value);
        } else {
            localStorage.removeItem('savedEmail');
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
});
