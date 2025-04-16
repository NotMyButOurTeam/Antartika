<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <title>Register</title>
    </head>
    <style>
    body {
        position: relative;
        width: 720px;
        margin: auto;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 8px;

        width: 100%;
        margin-top: 32px;
    }

    form div {
        width: 100%;
    }

    </style>
    <body>
        <h1>Register</h1>
        <form id="userRegisterForm" method="POST">
            <label>Nickname</label>
            <div>
                <input type="text" id="userName" name="userName" autocomplete="off" required>
            </div>
            <label>E-Mail</label>
            <div>
                <input type="email" id="userEmail" name="userEmail" autocomplete="off" placeholder="New E-Mail" required>
                <input type="email" id="verifyEmail" placeholder="Repeat E-Mail" autocomplete="off" required>
            </div>
            <label>Password</label>
            <div>
                <input type="password" id="userPassword" name="userPassword" autocomplete="off" placeholder="New Password" required>
                <input type="password" id="verifyPassword" autocomplete="off" placeholder="Repeat Password" required>
            </div>
            <button id="userSubmit">Register</button>
        </form>
        <script>
        const userRegisterForm = document.getElementById("userRegisterForm");

        const userName = document.getElementById("userName");

        const userEmail = document.getElementById("userEmail");
        const verifyEmail = document.getElementById("verifyEmail");

        const userPassword = document.getElementById("userPassword");
        const verifyPassword = document.getElementById("verifyPassword");

        const userSubmit = document.getElementById("userSubmit");
        if (userSubmit) {
            userSubmit.addEventListener("submit", (event) => {
                event.preventDefault();

                if (userEmail.value !== verifyEmail.value) {
                    alert("Email is not the same");
                    return;
                }

                if (userPassword.value !== verifyPassword.value) {
                    alert("Password is not the same");
                    return;
                }
                
                const formData = new FormData(userRegisterForm);

                fetch(window.location.href, {
                    method: "POST",
                    bodyL formData
                }).then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    }
                });
            });
        }
        </script>
    </body>
</html>
