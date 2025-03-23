<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="<?= base_url("script.js") ?>"></script>
        <link rel="stylesheet" href="<?= base_url("vendors/pixel-icon-library/fonts/iconfont.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <title><?= esc($title) ?> - Antartika</title>
    </head>
    <body>
        <header>
            <div>
                <h1 id="homeButton" class="clickable"><i class="icon hn hn-home-solid"></i> Home</h1>
            </div>
            <div class="searchbar">
                <form role="search" action="/apps/search">
                    <button id="submit"><i class="icon hn hn-search"></i></button><input type="text" id="search" name="q" placeholder="Search apps...">
                </form>
            </div>
            <div>
                <?php if (!empty(session()->get("userId"))): ?>
                    <h1 id="profileButton" class="clickable profile"><i class="icon hn hn-user-solid"></i> Profile</h1>
                    <h1 id="logoutButton" class="clickable logout"><i class="icon hn hn-logout-solid"></i> Log-Out</h1>
                <?php else: ?>
                    <h1 id="loginButton" class="clickable login"><i class="icon hn hn-login-solid"></i> Log-In</h1>
                    <h1 id="registerButton" class="clickable register"><i class="icon hn hn-plus-solid"></i> Register</h1>
                <?php endif; ?>
            </div>
        </header>

        <?php if(session()->get("userId")):?>
            <div id="profileBox" class="profile-box-container">
                <div class="profile-image">
                    <img src="<?= base_url(sprintf("uploads/accounts/profiles/%05d.png", session()->get("userId"))) ?>" onerror="this.src='<?= base_url("uploads/accounts/profiles/00000.png") ?>';">>
                </div>
                <h2><?= esc(session()->get("userName")) ?></h2>
                <p id="editProfileButton" class="clickable"><i class="icon hn hn-edit-solid"></i> Edit Profile</p>
            <?php if(session()->get("userPrivilege") < 2):?>
                <p id="dashboardButton" class="clickable"><i class="icon hn hn-bars-solid"></i> Dashboard</p>
                <p id="publishButton" class="clickable"><i class="icon hn hn-upload-alt-solid"></i> Publish</p>
            <?php else: ?>
                <p id="elevateButton" class="clickable"><i class="icon hn hn-users-crown-solid"></i> Became Publisher</p>
            <?php endif; ?>
        </div>
        <?php endif;?>

        <?php if(session()->get("userPrivilege") > 1): ?>
        <?php endif;?>
