<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script> 
        <title><?= esc($title) ?> - Antartika</title>
        <style>
        section {
            margin-top: 64px;
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

        .review-area {
            display: flex;
            flex-direction: column;
            gap: 32px;
            
            margin-top: 32px;
            margin-bottom: 32px;
        }

        section > h2 {
            margin-top: 32px;
            font-size: 24pt;
        }

        section > h3 {
            margin-top: 32px;
            text-align: center;
            font-size: 32pt;
        }

        .review-area {
            display: flex;
            flex-direction: column;
            gap: 32px;
            
            margin-top: 32px;
            margin-bottom: 32px;
            padding: 16px;

            border-radius: 15pt;
            background: #292c3c;
        }

        .review {
            display: flex;
            flex-direction: column;
            gap: 32px;
            padding: 16px;

            border-radius: 12pt;
            background: #303446;
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .review-header h3 {
            font-size: 12pt;
        }

        .review-header img {
            border-radius: 100%;
            width: 96px;
            height: 96px;
            object-fit: cover;
        }

        .review-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: auto;
            margin-top: 32px;
            gap: 8px;
            padding: 12px;

            color: #c6d0f5;
            background: #24273a;
            border-radius: 15pt;
        }

        .review-form button {
            border-radius: 15pt;
            height: 32px;
            width: 128px;
        }

        .review-form textarea {
            resize: none;
            width: 80%;
            height: 128px;
            
            border: none;
            outline: none;

            color: #c6d0f5;
            background: #494d64;
            border-radius: 15pt;
            padding: 16px;
        }

        .publisher-info {
            display: flex;
            align-items: center;
            gap: 32px;
            padding: 16px;

            background: #363a4f;
            margin-top: 32px;
            border-radius: 15pt;
        }

        .publisher-info img {
            border-radius: 100%;
            width: 96px;
            height: 96px;
        }

        a {
            color: #cad3f5;
            text-decoration: none;
        }

        .rating {
            margin: auto;
            margin-top: 32px;
            border-radius: 100%;
            height: 128px;
            width: 128px;
            padding-top: 36px;
            box-sizing: border-box;
            color: #a6d189;
            background: #40a02b;
        }

        .app-top {
            display: flex;
            justify-content: space-between;
        }

        .app-top button {
            display: block;
            margin: auto;
            margin-right: 0px;
            
            width: 128px;
            height: 32px;
            
            border-radius: 12px;
        }
        </style>
    </head>
    <body>
        <?= view("parts/header") ?>

        <section>
            <div class="app-top">
                <div class="app-header">
                    <img style="width: 128px; height: 128px;" src="<?= base_url("/uploads/apps/icons/" . sprintf("%05d.png", $id)) ?> " 
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h1><?= esc($title) ?></h1>
                </div>
                <?php if (session()->get("id") && session()->get("id") === $publisher["id"]): ?>
                    <form action="/app/edit/">
                        <input style="display:none" type="text" name="id" value="<?= $id ?>">
                        <button>Edit</button>
                    </form>
                <?php endif; ?>
                <?php if (session()->get("id") && session()->get("is_moderator") && isset($is_verified)): ?>
                    <form action="/mod/verify/" method="POST">
                        <input style="display:none" type="text" name="moderator" value="<?= session()->get("id") ?>">
                        <input style="display:none" type="text" name="app" value="<?= $id ?>">
                        <button>Verify</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php foreach(preg_split("/((\r?\n)|(\r\n?))/", $description) as $line): ?>
                <p><?= esc($line) ?></p>
            <?php endforeach; ?>

            <div class="app-previews-out">
                <div class="app-previews-in">
                <?php foreach ($previews as $preview): ?>
                    <img style="width:auto; height: 25vw;" src="<?= base_url("uploads/apps/previews/" . $preview) ?>">
                <?php endforeach;?>
                </div>
            </div>

            <h2>Tags</h2>
            <?php if (!empty($tags)): ?>
            <p style="color: #ef9f76; margin-top: 16px;"><?= esc($tags) ?></p>
            <?php else: ?>
            <p style="margin-top: 16px;">Not tagged</p>
            <?php endif; ?>

            <h2>Publisher</h2>
            <a href="/user/<?= sprintf("%05d", $publisher["id"]) ?>">
                <div class="publisher-info">
                    <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $publisher["id"])) ?> " 
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h2><?= esc($publisher["name"]) ?></h2>
                </div>
            </a>

            <h2 style="text-align: center;">Reviews</h2>
            <?php if (isset($rating)): ?>
            <h3 class="rating"><?= sprintf("%0.2f", esc($rating)) ?></h3>
            <?php else: ?>
            <p style="text-align: center;">No review yet...<p>
            <?php endif; ?>
            <?php if (session()->get("id")): ?>
            <form method="POST" class="review-form">
                <div>
                    <label>1</label>
                    <input type="radio" name="reviewRating" value="1" required>
                    <label>2</label>
                    <input type="radio" name="reviewRating" value="2">
                    <label>3</label>
                    <input type="radio" name="reviewRating" value="3">
                    <label>4</label>
                    <input type="radio" name="reviewRating" value="4">
                    <label>5</label>
                    <input type="radio" name="reviewRating" value="5">
                </div>
                <textarea name="reviewContent" placeholder="Write you view on the app!" required></textarea><br>
                <button>Submit</button>
            </form>
            <?php endif; ?>
            <?php if (isset($reviews)) :?>
            <div class="review-area">
                <?php foreach ($reviews as $review):?>
                <div class="review">
                    <div class="review-header">
                        <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $review["writer"]["id"])) ?> " 
                            onerror="this.src='<?= base_url("noicon.png") ?>';">
                        <a href="/user/<?= sprintf("%05d", $review["writer"]["id"]) ?>"><h3><?= $review["writer"]["name"] ?></h3></a>
                    </div>
                    <p>Rating: <?= esc($review["content"]["rating"]) ?></p>
                    <p><?= $review["content"]["content"] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif;?>
        </section>
    </body>
</html>
