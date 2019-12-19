<?php

require __DIR__ . '/views/header.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

$statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :id AND id = :postid");
$statement->execute([
    ":id" => $_SESSION["user"]["id"],
    ":postid" => $_GET["id"]
]);
$postinfo = $statement->fetch(PDO::FETCH_ASSOC);


?>

<section class="your-posts">

    <div class="post">

        <h2>Edit post</h2>

        <img src="/uploads/posts/<?php echo $postinfo["image"]; ?>" alt="">

        <form action="/app/posts/delete.php?id=<?php echo $_GET["id"]; ?>" method="post">

            <textarea name="deletepost" id="deletepost" cols="30" rows="10"><?php echo $postinfo["content"]; ?></textarea>

            <button class="delete" type="submit">Delete post</button>

        </form>

    </div>
</section>


<?php require __DIR__ . '/views/footer.php'; ?>