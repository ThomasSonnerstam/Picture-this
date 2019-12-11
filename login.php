<?php require __DIR__ . '/views/header.php'; ?>

<article class="login-page">
    <h1>Log in</h1>

    <form action="app/users/login.php" method="post">

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Enter email here" required>

        <?php if (isset($_SESSION["emailError"])) : ?>
            <p>
                <?php echo $_SESSION["emailError"]["wrongEmail"];
                    unset($_SESSION["emailError"]); ?>
            </p>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" name="password" required placeholder="Enter password here">

        <?php if (isset($_SESSION["passwordError"])) : ?>
            <p>
                <?php echo $_SESSION["passwordError"]["wrongPassword"];
                    unset($_SESSION["passwordError"]); ?>
            </p>
        <?php endif; ?>

        <button type="submit">Login</button>

    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>