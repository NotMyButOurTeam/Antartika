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

        <h2>Reviews</h2>
        <?php if (session()->get("id")): ?>
        <?php if (isset($rating)): ?>
        <h3><?= esc($rating) ?></h3>
        <?php else: ?>
        <h3>No review yet...</h3>
        <?php endif; ?>
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
        <?php if ($reviews) :?>
        <div class="review-area">
            <?php foreach ($reviews as $review):?>
            <div class="review">
                <div class="review-header">
                    <img src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", $id)) ?> " 
                        onerror="this.src='<?= base_url("noicon.png") ?>';">
                    <h3><?= $review["writer"]["name"] ?></h3>
                </div>
                <p>Rating: <?= esc($review["content"]["rating"]) ?></p>
                <p><?= $review["content"]["content"] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif;?>
    </body>
</html>
