<footer>
    <h1>Foot</h1>
<?php if (session()->get("user_id")): ?>
    <span>Welcome, <?= esc(session()->get('user_name')) ?>!</span>
<?php endif; ?>
</footer>
</body>
</html>
