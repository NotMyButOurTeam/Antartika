<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <title><?= esc($title) ?> - Antartika</title>
        <style>
        body {
            position: relative;
            
            width: 720px;
            margin: auto;
            margin-top: 8vw;
        }

        .app-header {
            display: flex;

            gap: 32px;
            align-items: center;

            margin-bottom: 64px;
        }

        .app-header h1 {
            font-size: 24pt;
        }

        .app-previews-out {
            width: 100%;
            overflow: scroll;

            margin-top: 64px;
            margin-bottom: 64px;
            padding: 32px;
        }

        .app-previews-in {
            display: flex;
            align-items: center;
            gap: 32px;

            width: 100vw;
        }
        </style>
    </head>
    <body>
        <div class="app-header">
            <img style="width: 128px; height: 128px;" src="<?= base_url("/uploads/apps/icons/" . sprintf("%05d.png", $id)) ?> " 
                onerror="this.src='<?= base_url("noicon.png") ?>';">
            <h1><?= esc($title) ?></h1>
        </div>

        <p><?= esc($description) ?></p>

        <div class="app-previews-out">
            <div class="app-previews-in">
            <?php foreach ($previews as $preview): ?>
                <img style="width:100%;" src="<?= base_url("uploads/apps/previews/" . $preview) ?>">
            <?php endforeach;?>
            </div>
        </div>
    </body>
</html>
