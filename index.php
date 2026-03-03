<?php include 'src/php/IndexController.php'; ?>

<?php include 'src/layout/header.html'; ?>

    <?php if($controller->isLoggedIn()): ?>
    <div class="welcome">
      <p class="welcome__text">Welcome, <?= $controller->getUsername() ?>!</p>
      <form method="post">
        <button class="welcome__button" type="submit" name="action" value="logout">Log out</button>
      </form>
    </div>
  <?php else: ?>
    <div class="admin-panel">
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2 class="admin-panel__title">Log in as admin</h2>

        <label class="admin-panel__label" for="username">Username</label>
        <input class="admin-panel__input" type="text" name="username" required>

        <label class="admin-panel__label" for="password">Password</label>
        <input class="admin-panel__input" type="password" name="password" required>

        <button class="admin-panel__button" type="submit" name="action" value="login">Log in</button>
      </form>

      <?php if($error = $controller->getLoginError()): ?>
        <p class="admin-panel__error"><?= $error ?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>


<?php include 'src/layout/footer.html'; ?>