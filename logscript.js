document.addEventListener("DOMContentLoaded", function() {
    // Fade in the form
    gsap.from(".container", { opacity: 0, duration: 1 });

    // Form submission animation
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission for this example

        // Perform form validation here...
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "") {
            // Show username error message
            gsap.to("#username-error", { opacity: 1, duration: 0.5, display: "block" });
            return;
        } else {
            // Hide username error message
            gsap.to("#username-error", { opacity: 0, duration: 0.5, display: "none" });
        }

        if (password === "") {
            // Show password error message
            gsap.to("#password-error", { opacity: 1, duration: 0.5, display: "block" });
            return;
        } else {
            // Hide password error message
            gsap.to("#password-error", { opacity: 0, duration: 0.5, display: "none" });
        }

        // Animate the form submission
        gsap.to(".container", { opacity: 0, duration: 0.5, onComplete: function() {
            // After animation completes, you can redirect to the login.php page or perform any other action
            console.log("Form submitted!");
        }});
    });

    // Input field focus animation
    var inputFields = document.querySelectorAll("input[type='text'], input[type='password']");
    inputFields.forEach(function(input) {
        input.addEventListener("focus", function() {
            gsap.to(input, { borderColor: "#4CAF50", duration: 0.5 });
        });

        input.addEventListener("blur", function() {
            gsap.to(input, { borderColor: "#ccc", duration: 0.5 });
        });
    });
});
