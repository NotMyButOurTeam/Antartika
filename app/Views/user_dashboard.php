<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script> 
        <title>Dashboard | Antartika</title>
    </head>
    <style>
    section {
        margin-top: 64px;
        width: 65vw;
        padding: 32px;
    }

    button {
        height: 32px;
        width: 196px;
        border-radius: 15pt;
    }

    .app-grid{
        display: grid;

        margin: auto;

        grid-template-columns: repeat(auto-fill, minmax(215px, max-content));
        grid-template-rows: repeat(auto-fill, minmax(215px, max-content));
    }

    .app {
        width: 176px;
        height: 176px;

        padding: 12px;

        background: #363a4f;
        border-radius: 15pt;
    }

    .app img {
        display: block;
        margin: auto;
        width: 128px;
        height: 128px;
    }

    .app p {
        text-align: center;
        font-size: 16pt;
    }

    a, a:visited {
        color: #cad3f5;
        text-decoration: none;
    }
    </style>
    <body>
        <?= view("parts/header") ?>
        <section>
            <form action="/app/submit">
                <button>Publish Application</button>
            </form>
            <br>
            <br>
            <br>
            <?php if ($apps): ?>
            <div class="app-grid">
                <?php foreach ($apps as $app): ?>
                <a href="/app/<?= sprintf("%05d", $app["id"]) ?>"><div class="app">
                    <img src="<?= base_url("uploads/apps/icons/" . sprintf("%05d.png", $app["id"])) ?>"
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <p><?= esc($app["title"]) ?></p>
                </div></a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p>You've not published any app yet...</p>
            <?php endif; ?>
        </section>
    </body>
</html>
