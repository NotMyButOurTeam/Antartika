<section>
    <link rel="stylesheet" href="<?= base_url("styles/account.css") ?>">
    <input type="file" id="fileInput" accept=".jpg, .png" style="display: none;">
    <div class="profile-page">
        <div id="profileImage" class="profile-image">
            <img src="<?= base_url(sprintf("uploads/accounts/profiles/%05d.png", session()->get("userId"))) ?>" onerror="this.src='<?= base_url("uploads/accounts/profiles/00000.png") ?>';">>
        </div>
        <h2 id="accountNameButton" class="clickable"><?= esc(session()->get("userName")) ?></h2>
        <p id="accountEmailButton" class="clickable"><?= esc($userEmail) ?></p>
        <p id="changePasswordButton" class="clickable">Change Password</p>
    </div>
    <div id="profileEditOverlay" class="profile-edit-overlay" tabindex="0">
    </div>
    <script src="<?= base_url("scripts/account.js") ?>"></script>
</section>
