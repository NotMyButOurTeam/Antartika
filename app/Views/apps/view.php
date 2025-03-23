<link rel="stylesheet" href="<?= base_url("/styles/app.css") ?>">
<section>
    <div class="app-container">
        <div class="app-header">
            <div style="display: flex; flex-direction: row; gap: 10px">
                <img class="app-icon" src="<?= base_url("/uploads/apps/icons/" . sprintf("%05d.png", $app["id"])) ?> " onerror="this.src='<?= base_url("uploads/apps/icons/00000.png") ?>';">
                <div class="app-title">
                    <h3><?= esc($app["name"]) ?></h3>
                    <h4>by</h4>
                    <h4><?= esc($publisher) ?></h4>
                </div>
            </div>
            <div>
                <?php if (session()->get("userId") == $app["publisher"]): ?>
                    <button id="editAppButton">Edit</button>
                <?php endif; ?>
                <?php if (session()->get("userPrivilege") == 0): ?>
                    <button style="background-color: #e64553; cursor: pointer;" id="banAppButton">Ban</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="app-banner-container">
    </div>
    <div class="app-container">
        <h1>Description</h1>
        <p><?= $app["description"] ?></p>
    </div>
</section>
<script src="<?= base_url("scripts/app.js") ?>"></script>
