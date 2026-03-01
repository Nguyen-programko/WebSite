    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Log in</title>
    </head>
    <?php include 'src/layout/header.html'; ?>

    <body>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h2>Log in as a admin</h2>
            <label for="username">Username</label><br>
            <input type="text" name="username"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required><br>
            <input type="submit" name="submit" value="login">
        </form>

    </body>


    <?php include 'src/layout/footer.html'; ?>
    </html>

    <?php include 'src/indexPHP.php' ?>

  