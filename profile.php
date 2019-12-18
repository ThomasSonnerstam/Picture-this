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

        <div class="post" data-id="<?php echo $post["id"]; ?>">

            <img src="/uploads/posts/<?php echo $post["image"]; ?>">
            <p><?php echo $post["content"]; ?></p>
            <button>
                <a href="/editpost.php?id=<?php echo $post["id"]; ?>">Edit</a>
            </button>
            <div class="post-line"></div>

        </div>


    <?php endforeach; ?>







</section>





<?php require __DIR__ . '/views/footer.php'; ?>