<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script>
        <title>Moderator Panel</title>

        <style>
        section {
            margin-top: 64px;
        }
        section > h1 {
            font-size: 24pt;
            text-align: center;
            margin-bottom: 64px;
        }

        .application {
            display: flex;
            align-items: center;
            gap: 32px;
            background: #363a4f;
            
            padding: 8px;
            border-radius: 15pt;
            
            cursor: pointer;
        }

        .application h2 {
            font-size: 24pt;
        }

        .application img {
            width: 128px;
            height: 128px;
        }
        </style>
    </head>
    <body>
        <?= view("parts/header") ?>
        <section>
            <h1>Unverified Applications</h1>
            <?php if (isset($apps)): ?>
            <div>
                <?php foreach ($apps as $app): ?>
                <a href="/app/<?= sprintf("%05d", $app["id"]) ?>"><div class="application">
                    <img src="<?= base_url("uploads/apps/icons/" . sprintf("%05d.png", $app["id"])) ?>"
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h2><?= $app["title"] ?></h2>
                </div></a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p>No unverified app found...</p>
            <?php endif; ?>
        </section>
    </body>
</html>
