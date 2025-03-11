<div class="content">
<form action="/register" method="post">
    <?= csrf_field() ?>
    <label for="name">User Name </label>
    <input type="text" id="name" name="name"><br>
    <label for="email">Email </label>
    <input type="text" id="email" name="email"><br>
    <label for="password0">New Password </label>
    <input type="text" id="password0" name="password0"><br>
    <label for="password1">Confirm Password </label>
    <input type="text" id="password1" name="password1"><br>
    <input type="submit" value="Register">
</form>
</div>
