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
        <?= view("parts/header.php") ?>
        <section>
            <form method="POST" class="app-edit-form">
                <input type="text" name="newTitle" value="<?= esc($title) ?>" 
                    placeholder="New title...">
                <textarea name="newDescription" 
                    placeholder="New description..."><?= esc($description) ?></textarea>
                <input type="text" name="newSource" value="<?= esc($source) ?>" 
                    placeholder="New source...">
                <input type="text" name="newTags" value="<?= esc($tags) ?>" 
                    placeholder="New Tags">
                <button>Save</button>
            </form>
        </section>
    </body>
</html>
