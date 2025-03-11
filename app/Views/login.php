<form action="/auth" method="post">
    <?= csrf_field() ?>
    <label for="name">Name </label>
    <input type="text" id="name" name="name"><br>
    <label for="password">Password </label>
    <input type="text" id="password" name="password"><br>
    <input type="submit" value="Login">
</form>
