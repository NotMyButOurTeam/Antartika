<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <title>Login</title>
    </head>
    <style>
    section {
        position: relative;
        width: 720px;
        margin: auto;
        margin-top: 15vw;
    }

    h1 {
        text-align: center;
        font-size: 24pt;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 32px;

        padding: 32px;
        border-radius: 15pt;
        width: 396px;
        margin: auto;
        margin-top: 32px;

        background: #303446;
    }

    form > div {
        display: block;
        margin: auto;

        width: 100%;
    }

    form > div input {
        display: block;
        height: 18px;
        width: 90%;
        padding: 8px;
        padding-left: 16pt;

        outline: none;
        border: none;
        border-radius: 15pt;

        margin: auto;
        margin-top: 8px;

        color: #c6d0f5;
        background: #626880;
    }

    button {
        display: block;
        margin: auto;
        border-radius: 15pt;
        width: 256px;
        height: 32px;
    }

    </style>
    <body>
        <section>
            <h1>Login</h1>
            <form id="userRegisterForm" method="POST">
                <div>
                    <label>E-Mail</label><br>
                    <input type="email" id="userEmail" name="userEmail" autocomplete="off" placeholder="E-Mail" required><br>
                </div>
                <div>
                    <label>Password</label><br>
                    <input type="password" id="userPassword" name="userPassword" autocomplete="off" placeholder="Password" required>
                </div>
                <button id="userSubmit">Login</button>
            </form>
        <section>
        <script>
        </script>
    </body>
</html>
