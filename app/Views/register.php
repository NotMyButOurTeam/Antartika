<section>
    <link rel="stylesheet" href="<?= base_url("styles/register.css") ?>">
    <div class="register-container">
        <h1>Register</h1>
        <h2 id="emailError" style="color: #d20f39; display: none;">E-Mail does not match...</h2>
        <h2 id="passwordError" style="color: #d20f39; display: none;">Password does not match...</h2>
        <h2 id="emptyError" style="color: #d20f39; display: none;">Please fill all required entry...</h2>
        <div class="register-form-container">
            <div>
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" required autocomplete="off" placeholder="Enter username">
            </div>
            <div>
                <label for="new_email">New E-Mail</label><br>
                <input type="text" id="newEmail" name="newEmail" required autocomplete="off" placeholder="Enter email">
            </div>
            <div>
                <label for="verify_email">Verify E-Mail</label><br>
                <input type="text" id="verifyEmail" name="verifyEmail" required autocomplete="off" placeholder="Verify email">
            </div>
            <div>
                <label for="new_password">New Password</label><br>
                <div class="password-box">
                    <input type="password" id="newPassword" name="newPassword" required autocomplete="off" placeholder="Enter password">
                    <p class="clickable" id="toggleNewPasswordButton" name="toggleNewPasswordButton"><i class="icon hn hn-eye-solid"></i></p>
                </div>
            </div>
            <div>
                <label for="verify_password">Verify Password</label><br>
                <div class="password-box">
                    <input type="password" id="verifyPassword" name="verifyPassword" required autocomplete="off" placeholder="Verify password">
                    <p class="clickable" id="toggleVerifyPasswordButton" name="toggleVerifyPasswordButton"><i class="icon hn hn-eye-solid"></i></p>
                </div>
            </div>
        </div>
        <button id="submitRegistrationButton" name="submitRegistrationButton">Register</button>
    </div>
    <script src="<?= base_url("scripts/register.js") ?>"></script>
</section>
