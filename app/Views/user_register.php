<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <title>Register</title>
    </head>
    <style>
    section {
        margin-top: 15vw;
    }

    h1 {
        font-size: 24pt;
        text-align: center;
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 8px;

        width: 396px;
        padding: 32px;
        margin: auto;
        margin-top: 64px;

        border-radius: 15pt;
        background: #303446;
    }

    form div {
        display: flex;
        width: 100%;
    }

    form input {
        border: none;
        outline: none;
        border-radius: 15pt;
        padding-left: 16pt;

        margin: auto;
        height: 32px;
        width: 42%;
        
        color: #c6d0f5;
        background: #626880;
    }

    form > label {
        margin-top: 8px;
    }

    form > button {
        height: 32px;
        margin-top: 16px;
        border-radius: 15pt;
    }

    </style>
    <body>
        <section>
            <h1>Register</h1>
            <form id="userRegisterForm" method="POST">
                <label>Nickname</label>
                <div>
                    <input style="width: 100%;" type="text" id="userName" name="userName" 
                        autocomplete="off" placeholder="Enter Nickname" required>
                </div>
                <label>E-Mail</label>
                <div>
                    <input type="email" id="userEmail" name="userEmail"
                        autocomplete="off" placeholder="New E-Mail" required>
                    <input type="email" id="verifyEmail" placeholder="Repeat E-Mail" 
                        autocomplete="off" required>
                </div>
                <label>Password</label>
                <div>
                    <input type="password" id="userPassword" name="userPassword" 
                        autocomplete="off" placeholder="New Password" required>
                    <input type="password" id="verifyPassword" 
                        autocomplete="off" placeholder="Repeat Password" required>
                </div>
                <button id="userSubmit">Register</button>
            </form>
        <section>
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
