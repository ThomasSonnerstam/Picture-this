<?php

require __DIR__ . '/views/header.php';

// Edit post

$statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :id AND id = :postid");
$statement->execute([
    ":id" => $_SESSION["user"]["id"],
    ":postid" => $_GET["id"]
]);
$editpost = $statement->fetch(PDO::FETCH_ASSOC);

// die(var_dump($_GET));

?>
<section class="your-posts">

    <div class="post">

        <h2>Edit post</h2>

        <img src="/uploads/posts/<?php echo $editpost["image"]; ?>" alt="">

        <form action="/app/posts/update.php" method="post">

            <textarea name="editpost" id="editpost" cols="30" rows="10"><?php echo $editpost["content"]; ?></textarea>

            <button type="submit">Update post</button>

        </form>

    </div>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>