<div id="profileBox" class="profile-box">
    <img 
        src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
        onerror="this.src='<?= base_url("noprof.png") ?>';">
    <?php if (session()->get("id")): ?>
    <h2 style="font-size: 18pt;"><?= esc(session()->get("name")) ?></h2>
    <div>
        <form action="/user/edit">
            <button>Edit Profile</button>
        </form>
        <?php if (session()->get("is_publisher")): ?>
        <form action="/user/dashboard">
            <button>Dashboard</button>
        </form>
        <?php endif; ?>
    </div>
    <form action="/user/logout">
        <button>Logout</button>
    </form>
    <?php else: ?>
    <div>
        <form action="/user/login">
            <button id="loginButton">Login</button>
        </form>
        <form action="/user/register">
            <button id="registerButton">Register</button>
        </form>
    </div>
    <?php endif; ?>
</div>
