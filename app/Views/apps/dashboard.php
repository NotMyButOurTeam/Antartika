<link rel="stylesheet" href="<?= base_url("styles/dashboard.css") ?>">
<section>
    <div class="dashboard-container">
        <h1>Your Apps</h1>
        <?php if (!empty($apps)): ?>
            <div class="dashboard-app-grid">
                <?php foreach($apps as $app): ?>
                    <a href="<?= base_url("/apps/id/" . $app["id"]) ?>">
                        <div class="app">
                            <img class="app-icon" src="<?= base_url("uploads/apps/icons/" . sprintf("%05d.png", $app["id"]) ) ?>">
                            <h3><?= $app["name"] ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h2>You have not published any apps...</h2>
        <?php endif; ?>
    </div>
</section>
