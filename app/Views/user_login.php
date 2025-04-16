<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <title>Login</title>
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

    </style>
    <body>
        <h1>Login</h1>
        <form id="userRegisterForm" method="POST">
            <label>E-Mail</label><br>
            <input type="email" id="userEmail" name="userEmail" autocomplete="off" placeholder="E-Mail" required><br>
            <label>Password</label><br>
            <input type="password" id="userPassword" name="userPassword" autocomplete="off" placeholder="Password" required>
            <button id="userSubmit">Login</button>
        </form>
        <script>
        </script>
    </body>
</html>
