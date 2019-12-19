<?php require __DIR__ . '/views/header.php'; ?>

<article class="homepage">
    <?php if (isset($_SESSION["user"])) : ?>

        <h2 class="welcome-text">
            Welcome <?php echo $_SESSION["user"]["name"]; ?>
        </h2>

        <?php if (isset($_SESSION["errors"])) : ?>
            <p class="error">
                <?php $errors = $_SESSION["errors"];
                foreach ($errors as $error) : ?>
                    <?php echo $error; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION["errors"]); ?>
            </p>
        <?php endif; ?>

        <section class="new-post">
            <form action="/app/posts/store.php" method="post" enctype="multipart/form-data">
                <h2>New post</h2>
                <label for="newpost">
                    Choose image:
                    <img class="upload-image" src="/assets/images/index-logo.png" alt="Image of a camera">
                </label>
                <input type="file" accept="image/jpeg, image/png" name="newpost" id="newpost">
                <p>Caption:</p>
                <textarea class="write-new-post" name="caption" id="caption" cols="30" rows="10"></textarea>
                <button type="submit">Post</button>

            </form>
        </section>




        <!-- If you're not logged in, this will show on the homepage instead -->
    <?php else : ?>
        <h1><?php echo $config['title']; ?></h1>
        <img class="homepage-image" src="/assets/images/homepage.jpg" alt="">
        <p>Welcome to Picture This, the newest social media platform without
            any advertisement! Click on "Sign up" to create your account today!
        </p>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>