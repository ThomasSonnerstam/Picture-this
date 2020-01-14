<?php require __DIR__ . '/views/header.php'; ?>
<?php require __DIR__ . '/app/users/showuserinfo.php';

?>

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

        <!-- Posts -->

        <?php foreach ($posts as $post) : ?>

            <?php $statement = $pdo->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND post_id = :post_id");

            $statement->execute([
                ":user_id" => $_SESSION["user"]["id"],
                ":post_id" => $post["id"]
            ]);

            $isLike = $statement->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="post" data-id="<?php echo $post["id"]; ?>">

                <img class="post-image" src="/uploads/posts/<?php echo $post["image"]; ?>">

                <form class="reactions" action="/app/posts/reactions.php" method="post">
                    <input type="hidden" name="postId" value="<?php echo $post["id"]; ?>">
                    <button class="hidden-button" type="submit" value="Like" name="like">
                        <img class="like-image" src="/assets/images/<?php echo !empty($isLike) ? "like.png" : "emptylike.png"; ?>" alt="Image of a heart">
                    </button>
                </form>

                <p><?php echo $post["content"]; ?></p>

                <div class="post-line"></div>
            </div>

        <?php endforeach; ?>

        <!-- If you're not logged in, this will show on the homepage instead -->
    <?php else : ?>
        <h1><?php echo $config['title']; ?></h1>

        <img class="homepage-image" src="/assets/images/homepage.jpg" alt="">

        <p>Welcome to Picture This, the newest social media platform without
            any advertisement! Click on "Sign up" to create your account today!
        </p>
    <?php endif; ?>
</article>

<script src="/assets/scripts/like.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>