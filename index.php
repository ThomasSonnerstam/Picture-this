<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <?php if (isset($_SESSION["user"])) : ?>
        <h2>
            Welcome <?php echo $_SESSION["user"]["name"]; ?>
        </h2>
    <?php endif; ?>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>