<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= esc($query) ?> | Antartika</title>
        <style>
        section {
            margin: auto;
            margin-top: 64px;
            width: 720px;
        }

        .application {
            display: flex;
            align-items: center;
            gap: 32px;
            width: 95%;
            height: 128px;
            padding: 12px;

            background: #363a4f;
            border-radius: 15pt;
        }

        .application h2 {
            font-size: 24pt;
        }

        .application img {
            width: 128px;
            height: 128px;
        }

        .application-row {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        a, a:visited {
            color: #cad3f5;
            text-decoration: none;
        }
        </style>
    </head>
    <home>
        <header>
            <div></div>
            <form action="/app/search" class="search-form">
                <div>
                    <input type="text" name="q" placeholder="Enter app name..."
                        <?php if (isset($search)): ?>
                        value="<?= esc($search) ?>"
                        <?php endif; ?>
                    >
                    <button>→</button>
                </div>
            </form>
            <img id="profileButton"
                src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
                onerror="this.src='<?= base_url("noprof.png") ?>';">
        </header>
        <?= view("parts/header_click") ?>
        <section>
            <?php if (isset($results)): ?>
            <div class="application-row">
                <?php foreach($results as $app): ?>
                <a href="/app/<?= sprintf("%05d", $app["id"]) ?>"><div class="application">
                    <img src="<?= base_url("uploads/apps/icons/" . sprintf("%05d.png", $app["id"])) ?>"
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h2><?= esc($app["title"]) ?></h2>
                </div></a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p>No app found...</p>
            <?php endif; ?>
        </section>
    </home>
</html>
