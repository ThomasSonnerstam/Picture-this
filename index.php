<?php require __DIR__ . '/views/header.php'; ?>

<article class="homepage">
    <?php if (isset($_SESSION["user"])) : ?>
        <h2 class="welcome-text">
            Welcome <?php echo $_SESSION["user"]["name"]; ?>
        </h2>
    <?php else : ?>
        <h1><?php echo $config['title']; ?></h1>
        <img class="homepage-image" src="/assets/images/homepage.jpg" alt="">
        <p>Welcome to Picture This, the newest social media platform without
            any advertisement! Click on "Sign up" to create your account today!
        </p>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>