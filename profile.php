<?php

require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

?>

<section class="your-posts">

    <h2>Your posts</h2>

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

            <div class="reaction-wrapper">

                <form class="reactions" action="/app/posts/reactions.php" method="post">

                    <input type="hidden" name="postId" value="<?php echo $post["id"]; ?>">
                    <button class="hidden-button" type="submit" value="Like" name="like">
                        <img class="like-image" src="/assets/images/<?php echo !empty($isLike) ? "like.png" : "emptylike.png"; ?>" alt="Image of a heart">
                    </button>

                </form>

                <img class="comment-image" src="/assets/images/comment.png" alt="Image of a text bubble">

            </div>

            <p><?php echo $post["content"]; ?></p>

            <div class="button-wrapper">
                <button>
                    <a href="/editpost.php?id=<?php echo $post["id"]; ?>">Edit</a>
                </button>
                <button class="delete">
                    <a href="/deletepost.php?id=<?php echo $post["id"]; ?>">Delete post</a>
                </button>
            </div>

            <div class="post-line"></div>

        </div>

    <?php endforeach; ?>

</section>

<script src="/assets/scripts/like.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>