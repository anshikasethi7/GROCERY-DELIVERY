document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = event.target.elements.username.value;
            const password = event.target.elements.password.value;
            
            // Here you can add your registration logic
            console.log('Registering...', { username, password });
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const username = event.target.elements.username.value;
            const password = event.target.elements.password.value;
            
            // Here you can add your login logic
            console.log('Logging in...', { username, password });
        });
    }
});
