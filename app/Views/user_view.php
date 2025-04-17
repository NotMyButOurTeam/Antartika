<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?= base_url('reset.css') ?>">
        <title><?= esc($name) ?></title>
        <style>
        body {
            position: relative;
            
            width: 720px;
            margin: auto;
            margin-top: 32px;
        }

        body > h1, body > p {
            text-align: center;
        }

        body > img {
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
        }

        body > h3 {
            margin-top: 32px;
            text-align: center;
            font-size: 32pt;
        }

        .review {
            display: flex;
            flex-direction: column;
            gap: 32px;
            padding: 16px;
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

        form {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 16px;
            padding: 32px;
        }

        form textarea {
            resize: none;
            width: 100%;
            height: 128px;
        }
        </style>
    </head>
    <body>
        <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $id)) ?> " 
            onerror="this.src='<?= base_url("noicon.png") ?>';">
        <h1><?= esc($name) ?></h1>

        <?php if ($profile): ?>
        <p><?= esc($profile) ?></p>
        <?php else: ?>
        <p>No profile yet...</p>
        <?php endif; ?>

        <?php if (isset($reputation)): ?>
        <h2>Reviews</h2>
        <h3><?= esc($reputation) ?></h3>
        <?php if (session()->get("id")): ?>
        <form method="POST">
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
            <textarea name="reviewContent" required></textarea><br>
            <button>Submit</button>
        </form>
        <?php endif; ?>
        <?php if (isset($reviews)) :?>
        <div class="review-area">
            <?php foreach ($reviews as $review):?>
            <div class="review">
                <div class="review-header">
                    <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $id)) ?> " 
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h3><?= $review["writer"]["name"] ?></h3>
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
    </body>
</html>
