<?php require __DIR__ . '/views/header.php'; ?>

<article class="login-page">

    <h1>Log in</h1>

    <?php if (isset($_SESSION["errors"])) : ?>
        <p class="error">
            <?php $errors = $_SESSION["errors"];
            foreach ($errors as $error) : ?>
                <?php echo $error; ?>
            <?php endforeach; ?>
            <?php unset($_SESSION["errors"]); ?>
        </p>
    <?php endif; ?>

    <form action="app/users/login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Enter email here" required>

        <label for="password">Password</label>
        <input type="password" name="password" required placeholder="Enter password here">

        <button type="submit">Login</button>
    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>