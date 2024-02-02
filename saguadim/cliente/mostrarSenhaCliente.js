document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordButtons = document.querySelectorAll(".toggle-password");

    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    }

    togglePasswordButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const fieldId = button.getAttribute("data-field-id");
            togglePassword(fieldId);
        });
    });
});