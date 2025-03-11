<div class="content">
<form method="post">
    <?= csrf_field() ?>
    <label for="email">Email </label>
    <input type="text" id="email" name="email"><br>
    <label for="password">Password </label>
    <input type="text" id="password" name="password"><br>
    <input type="submit" value="Login">
</form>
</div>
