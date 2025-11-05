document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password-input");
    const toggleButton = document.getElementById("password-addon");

    if (passwordInput && toggleButton) {
        const icon = toggleButton.querySelector("i");

        toggleButton.addEventListener("click", function () {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            icon.classList.toggle("ri-eye-line", !isPassword);
            icon.classList.toggle("ri-eye-off-line", isPassword);
        });
    }
});
