<link rel="stylesheet" href="<?= base_url("styles/search.css") ?>">
<section>
    <?php if (!empty($data)): ?>
        <div class="apps-container">
            <?php foreach($data as $app): ?>
                <a href="<?= base_url("/apps/id/" . $app["id"]) ?>">
                    <div class="app">
                        <img class="app-icon" src="<?= base_url("uploads/apps/icons/" . sprintf("%05d.png", $app["id"]) ) ?>">
                        <h3><?= $app["name"] ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="apps-empty">
            <h3>No apps found...</h3>
        </div>
    <?php endif; ?>
</section>
