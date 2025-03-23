const password = document.getElementById("password");

let togglePasswordButton = document.getElementById("togglePasswordButton");
if (togglePasswordButton) {
    if (password) {
        togglePasswordButton.addEventListener("click", function() {
            if (password.type === "password") {
                togglePasswordButton.innerHTML = "<i class='icon hn hn-eye-cross-solid'></i>";
                password.type = "text";
            } else {
                togglePasswordButton.innerHTML = "<i class='icon hn hn-eye-solid'></i>";
                password.type = "password";
            }
        });
    }
}
