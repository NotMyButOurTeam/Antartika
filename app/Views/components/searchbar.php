<form action="/search" method="post">
    <?= csrf_field() ?>
    <input type="text" id="search" name="search" value="<?= set_value("search") ?>">
    <input type="submit" value="Search">
</form>
