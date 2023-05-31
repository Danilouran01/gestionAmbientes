function togglePasswordVisibility() {
    var contrasenaInput = document.getElementById("contrasena");
    var toggleIcon = document.getElementById("toggle-icon");
    
    if (contrasenaInput.type === "password") {
        contrasenaInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        contrasenaInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}
