<?php include 'src/php/indexPHP.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Log in</title>
</head>
<?php include 'src/layout/header.html'; ?>

<body>

    <?php if($auth->isLoggedIn()): ?>

        <p>Welcome, <?= $_SESSION["username"] ?>!</p>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <button type="submit" name="action" value="logout">Log out</button>
        </form>

    <?php else: ?>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h2>Log in as admin</h2>
            <label for="username">Username</label><br>
            <input type="text" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required><br>
            <button type="submit" name="action" value="login">Log in</button>
        </form>

        <?php if(isset($loginError)): ?>
            <p style="color:red"><?= $loginError ?></p>
        <?php endif; ?>

    <?php endif; ?>

</body>

<?php include 'src/layout/footer.html'; ?>
</html>