async function sendData(nameText, emailText, passwordText) {
    if (nameText.length !== 0 && emailText.length !== 0 && passwordText.length !== 0) {
        let formData = new FormData();
        formData.append("name", nameText);
        formData.append("email", emailText);
        formData.append("password", passwordText);

        let response = await fetch("/register", {
            method: "POST",
            body: formData,
            redirect: "follow"
        });

        if (response.redirected) {
            window.location.href = response.url;
        } else {
            console.log(response);
            alert("Submission not accepted due to server error!");
        }
    }
}

const name = document.getElementById("name");
const newEmail = document.getElementById("newEmail");
const verifyEmail = document.getElementById("verifyEmail");
const newPassword = document.getElementById("newPassword");
const verifyPassword = document.getElementById("verifyPassword");

window.addEventListener("keypress", function(event) {
    if (event.key == "Enter") {
        const submitRegistrationButton = document.getElementById("submitRegistrationButton");
        if (submitRegistrationButton) {
            submitRegistrationButton.click();
        }
    }
});

let toggleNewPasswordButton = document.getElementById("toggleNewPasswordButton");
if (toggleNewPasswordButton) {
    if (newPassword) {
        toggleNewPasswordButton.addEventListener("click", function() {
            if (newPassword.type === "password") {
                toggleNewPasswordButton.innerHTML = "<i class='icon hn hn-eye-cross-solid'></i>";
                newPassword.type = "text";
            } else {
                toggleNewPasswordButton.innerHTML = "<i class='icon hn hn-eye-solid'></i>";
                newPassword.type = "password";
            }
        });
    }
}

let toggleVerifyPasswordButton = document.getElementById("toggleVerifyPasswordButton");
if (toggleVerifyPasswordButton) {
    if (verifyPassword) {
        toggleVerifyPasswordButton.addEventListener("click", function() {
            if (verifyPassword.type === "password") {
                toggleVerifyPasswordButton.innerHTML = "<i class='icon hn hn-eye-cross-solid'></i>";
                verifyPassword.type = "text";
            } else {
                toggleVerifyPasswordButton.innerHTML = "<i class='icon hn hn-eye-solid'></i>";
                verifyPassword.type = "password";
            }
        });
    }
}

const submitRegistrationButton = document.getElementById("submitRegistrationButton");
if (submitRegistrationButton) {
    submitRegistrationButton.addEventListener("click", function() {
        if (newPassword != null && verifyPassword != null) {
            const passwordError = document.getElementById("passwordError");
            if (passwordError) {
                if (newPassword.value !== verifyPassword.value) {
                    passwordError.style.display = "block";
                } else {
                    passwordError.style.display = "none";
                }
            }
        }

        if (newEmail != null && verifyEmail != null) {
            const emailError = document.getElementById("emailError");
            if (emailError) {
                if (newEmail.value !== verifyEmail.value) {
                    emailError.style.display = "block";
                } else {
                    emailError.style.display = "none";
                }
            }
        }

        if (newPassword != null && verifyPassword != null && newEmail != null && verifyEmail != null && name != null) {
            const emptyError = document.getElementById("emptyError");
            if (emptyError) {
                if (name.length === 0 || newPassword.length === 0 || newEmail.length === 0) {
                    emptyError.style.display = "block";
                } else {
                    emptyError.style.display = "none";
                }
            }

            if (newPassword.value === verifyPassword.value && newEmail.value === verifyEmail.value) {
                sendData(name.value, newEmail.value, newPassword.value);
            }
        } else {
            alert("There is something wrong going on with the website please come back later...");
        }
    });
}
