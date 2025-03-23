<section>
    <link rel="stylesheet" href="<?= base_url("styles/login.css") ?>">
    <div class="login-form-container">
        <h1>Log-In</h1>
        <?php if (session()->getFlashdata("error")): ?>
            <h2 style="color: #d20f39;"><?= esc(session()->getFlashdata("error")) ?></h2>
        <?php endif; ?>
        <form method="post">
            <div>
                <div>
                    <label for="email">E-Mail</label><br>
                    <input type="text" id="email" name="email" required placeholder="Enter email"><br>
                </div>
                <div>
                    <label for="password">Password</label><br>
                    <div class="password-box">
                        <input type="password" id="password" name="password" required autocomplete="off" placeholder="Enter password">
                        <p class="clickable" id="togglePasswordButton" name="togglePasswordButton"><i class="icon hn hn-eye-solid"></i></p>
                    </div>
                </div>
            </div>
            <button id="loginConfirmationButton">Log-In</button>
        </form>
    </div>
    <script src="<?= base_url("scripts/login.js") ?>"></script>
</section>
