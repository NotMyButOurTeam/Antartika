<h2>Search results</h2>
<?php if(!empty($results)): ?>
    <?php foreach ($results as $app): ?>
        <div>
            <h3><?= esc($app["name"]) ?></h3>
            <p><?= esc($app["description"]) ?><p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h3>No results found...</h3>
<?php endif; ?>
