<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title)?> - Antartika</title>
    <link rel="stylesheet" href="<?= base_url("style.css") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div>
            <h1><a href="<?= base_url("/") ?>">Antartika</a></h1>
        </div>
        <?php if(session()->get("user_id")): ?>
            <div>
                <a href="<?= base_url("logout") ?>">Log-Out</a>
            </div>
        <?php elseif ($title == "Login" or $title == "Register"): ?>
        <?php else: ?>
            <div>
                <a href="<?= base_url("login") ?>">Log-In</a>
                <a href="<?= base_url("register") ?>">Register</a>
            </div>
        <?php endif; ?>
    </header>
