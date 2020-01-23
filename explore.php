<?php

require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

// In this file users can view other users posts and go to their profiles and follow them

//die(var_dump(getAllPostsWithUserInfo($pdo)));

$allPosts = getAllPostsWithUserInfo($pdo);

?>

<?php foreach ($allPosts as $randomPost) : ?>

    <?php
    // Fetching name & id of the owner of the post to be able to go to their profile and follow him/her
    $postUserId = $randomPost['user_id'];
    $firstName = $randomPost['first_name'];
    $lastName = $randomPost['last_name'];
    ?>

    <?php $statement = $pdo->prepare("SELECT * FROM reactions WHERE user_id = :user_id AND post_id = :post_id");

    $statement->execute([
        ":user_id" => $_SESSION["user"]["id"],
        ":post_id" => $randomPost["id"]
    ]);

    $isLike = $statement->fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="post" data-id="<?php echo $randomPost["id"]; ?>">
        <h3><a href="userprofile.php?id=<?php echo $postUserId; ?>"><?php echo "$firstName $lastName"; ?></a></h3>

        <img class=" post-image" src="/uploads/posts/<?php echo $randomPost["image"]; ?>">

        <form class="reactions" action="/app/posts/reactions.php" method="post">
            <input type="hidden" name="postId" value="<?php echo $randomPost["id"]; ?>">
            <button class="hidden-button" type="submit" value="Like" name="like">
                <img class="like-image" src="/assets/images/<?php echo !empty($isLike) ? "like.png" : "emptylike.png"; ?>" alt="Image of a heart">
            </button>
        </form>

        <p><?php echo $randomPost["content"]; ?></p>

        <div class="post-line"></div>
    </div>

<?php endforeach; ?>

<script src="/assets/scripts/like.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>