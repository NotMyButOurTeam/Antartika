<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?= base_url('reset.css') ?>">
        <link rel="stylesheet" href="<?= base_url('style.css') ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script>
        <title>Edit App | Antartika</title>
        <style>
        section {
            margin-top: 64px;

            display: flex;
        }

        .app-edit-form {
            display: flex;
            gap: 12px;
            flex-direction: column;
            width: 100%;
        }

        .app-edit-form textarea {
            height: 360px;
            resize: none;
        }

        .app-edit-form input[type=text], 
        .app-edit-form textarea {
            border: none;
            outline: none;
            
            padding: 12px;
            border-radius: 15pt;

            color: #c6d0f5;
            background: #414559;
        }

        .app-edit-form button {
            display: block;
            margin: auto;

            width: 128px;
            height: 32px;
            border-radius: 15pt;
        }

        .app-edit-images {
            display: flex;
            flex-direction: column;
        }
        </style>
    </head>
    <body>
        <header>
            <div></div>
            <form action="/app/search" class="search-form">
                <div>
                    <input type="text" name="q" placeholder="Enter app name...">
                    <button>→</button>
                </div>
            </form>
            <img id="profileButton"
                src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
                onerror="this.src='<?= base_url("noprof.png") ?>';">
        </header>
        <?= view("parts/header_click") ?>
        <section>
            <form method="POST" class="app-edit-form">
                <input type="text" name="newTitle" value="<?= esc($title) ?>" 
                    placeholder="New Title">
                <textarea name="newDescription" 
                    placeholder="New Description"><?= esc($description) ?></textarea>
                <input type="text" name="newTags" value="<?= esc($tags) ?>" 
                    placeholder="New Tags">
                <button>Save</button>
            </form>
        </section>
    </body>
</html>
