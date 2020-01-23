<?php

require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

// In this file we view users profiles

$idFromGet = (int) $_GET['id'];
$profile = fetchUserWithGet($pdo, $idFromGet);
$profileId = (int) $profile['id'];
$profileFirstName = $profile['first_name'];
$profileLastName = $profile['last_name'];
$profileBio = $profile['biography'];
var_dump($idFromGet);

$userId = (int) $_SESSION['user']['id'];
?>

<section class="user-profile">
    <div class="user-profile__info">

        <img src="" alt="Profile picture">

        <h3><?php echo "$profileFirstName $profileLastName"; ?></h3>

        <p><?php echo $profileBio; ?></p>

        <form class="follow" action="/app/users/follows.php" method="post">
            <input type="hidden" name="following" value="<?php echo $idFromGet; ?>"></input>
            <?php if (isFollowing($pdo, (int) $userId, (int) $profileId)) : ?>
                <button name="follower" value="<?php echo $userId; ?>">Unfollow</button>
            <?php elseif (!isFollowing($pdo, (int) $userId, (int) $profileId)) : ?>
                <button name="follower" value="<?php echo $userId; ?>">Follow</button>
            <?php endif; ?>
        </form>
    </div>

    <?php $userPosts = getPostsByUser($pdo, $idFromGet); ?>
    <?php foreach ($userPosts as $userPost) : ?>
        <div class="post user-profile__posts" data-id="<?php echo $userPost["id"]; ?>">

            <h4><a href="userprofile.php"><?php echo $userPost['first_name']; ?></a></h4>

            <img class="post-image" src="/uploads/posts/<?php echo $userPost["image"]; ?>">

            <form class="reactions" action="/app/posts/reactions.php" method="post">
                <input type="hidden" name="postId" value="<?php echo $userPost["id"]; ?>">
                <button class="hidden-button" type="submit" value="Like" name="like">
                    <img class="like-image" src="/assets/images/<?php echo !empty($isLike) ? "like.png" : "emptylike.png"; ?>" alt="Image of a heart">
                </button>
            </form>

            <p><?php echo $userPost["content"]; ?></p>

            <div class="post-line"></div>
        </div>
    <?php endforeach; ?>
</section>

<script src="/assets/scripts/like.js"></script>

<?php require __DIR__ . '/views/footer.php'; ?>