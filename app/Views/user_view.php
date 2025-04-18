<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?= base_url('reset.css') ?>">
        <link rel="stylesheet" href="<?= base_url('style.css') ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script> 
        <title><?= esc($name) ?></title>
        <style>
        section {
            position: relative;
            
            width: 720px;
            margin: auto;
            margin-top: 32px;
        }

        section > h1 {
            font-size: 24pt;
            padding-bottom: 48pt;
            <?php if ($is_publisher): ?>
            color: #a6d189;
            <?php endif; ?>
        }

        section > h1, body > p {
            text-align: center;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        section > h3 {
            margin-top: 32px;
            text-align: center;
            font-size: 32pt;
        }

        section > h2 {
            font-size: 18pt;
            margin-top: 64px;
            text-align: center;
        }

        section > img {
            display: block;
            border-radius: 100%;
            margin: auto;

            width: 256px;
            height: 256px;
            object-fit: cover;
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

        a {
            color: #c6d0f5;
            text-decoration: none;
        }

        a:visited {
            color: #c6d0f5;
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

        .reputation {
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
        </style>
    </head>
    <body>
        <header>
            <img id="profileButton"
                src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
                onerror="this.src='<?= base_url("noprof.png") ?>';">
        </header>
        <?= view("parts/header_click") ?>
        <section>
            <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $id)) ?> " 
                onerror="this.src='<?= base_url("noicon.png") ?>';">
            <h1><?= esc($name) ?></h1>

            <?php if ($profile): ?>
            <p><?= esc($profile) ?></p>
            <?php else: ?>
            <p>No profile yet...</p>
            <?php endif; ?>

            <?php if (isset($reputation)): ?>
            <h2>Reputations</h2>
            <h3 class="reputation"><?= esc($reputation) ?></h3>
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
                <textarea name="reviewContent" required placeholder="Write your comment on the guy!"></textarea><br>
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
                    <p>Gave <?= esc($review["content"]["rating"]) ?> Reputation to <?= esc($name) ?></p>
                    <p><?= $review["content"]["content"] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <h3>No review yet...</h3>
            <?php endif;?>
            <?php endif;?>
        </section>
    </body>
</html>
