<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
 * Function to get the data from the current logged in user.
 *
 * @param object $pdo
 * @return array
 */
function getUsersById(object $pdo): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

/**
 * Function to get the data from the user the post belongs to.
 *
 * @param PDO $pdo
 * @param int $postUserId
 * @return array
 */
function getUserOfPost(PDO $pdo, int $postUserId): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");

    $statement->execute([
        ":id" => $postUserId
    ]);

    $postOwner = $statement->fetch(PDO::FETCH_ASSOC);

    return $postOwner;
}

/**
 * Function fetching user from GET
 *
 * @param PDO $pdo
 * @param int $idFromGet
 * @return array
 */
function fetchUserWithGet(PDO $pdo, int $idFromGet): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");

    $statement->execute([
        ":id" => $idFromGet
    ]);

    $userProfile = $statement->fetch(PDO::FETCH_ASSOC);

    return $userProfile;
}

/**
 * Checking if logged in user is following another user
 * 
 * @param PDO $pdo
 * @param int $follower
 * @param int $isFollowingUserId
 * 
 * @return array 
 */
function isFollowing(PDO $pdo, int $follower, int $isFollowingUserId)
{
    $statement = $pdo->prepare('SELECT * FROM follows WHERE user_id_that_follows = :user_id AND user_id_that_is_followed = :is_following_id');

    $statement->execute([
        ':user_id' => $follower,
        ':is_following_id' => $isFollowingUserId
    ]);

    $isFollowed = $statement->fetch(PDO::FETCH_ASSOC);

    return $isFollowed;
}

/**
 * Returns all posts with user information
 * 
 * @param PDO $pdo
 * 
 * @return array
 */
function getAllPostsWithUserInfo(PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT posts.id, posts.user_id, posts.image, posts.content, users.id, users.first_name, users.last_name, users.profile_picture FROM posts JOIN users ON posts.user_id = users.id ORDER BY random()');

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allPosts;
}

/**
 * Returns all posts from one user with user information 
 * 
 * @param PDO $pdo
 * @param int $id
 * 
 * @return array
 */
function getPostsByUser(PDO $pdo, int $id): array
{
    $statement = $pdo->prepare('SELECT posts.id, posts.user_id, posts.image, posts.content, users.id, users.first_name, users.last_name, users.profile_picture FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id = :id ORDER BY posts.id ASC');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $id
    ]);

    $allPostsByUser = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allPostsByUser;
}

/**
 * Returns all posts from users the user is following inlcuding his/her own posts
 * 
 * @param PDO $pdo
 * @param int $id
 * 
 * @return array
 */
function getAllPostsFromFollowings(PDO $pdo, int $id): array
{
    $statement = $pdo->prepare(
        'SELECT posts.id, posts.user_id, posts.image, posts.content 
        FROM posts 
        JOIN follows 
        ON posts.user_id = follows.user_id_that_is_followed
        WHERE follows.user_id_that_follows = :id 
        ORDER BY posts.id ASC'
    );

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':id' => $id
    ]);

    $allPostsFromFollowings = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allPostsFromFollowings;
}

/**
 * Returns all comments from a post
 * 
 * @param PDO $pdo
 * @param int $postId
 * 
 * @return array
 */
function getAllCommentsToAPost(PDO $pdo, int $postId): array
{
    $statement = $pdo->prepare(
        'SELECT comments3.id, comments3.user_id, comments3.post_id, comments3.comment, comments3.reply_to_comment_id, users.first_name, users.last_name FROM comments3 
    LEFT JOIN users
    ON comments3.user_id = users.id
    WHERE post_id = :post_id'
    );

    // SELECT posts.id, posts.user_id, posts.image, posts.content 
    // FROM posts 
    // JOIN follows 
    // ON posts.user_id = follows.user_id_that_is_followed
    // WHERE follows.user_id_that_follows = :id 

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ":post_id" => $postId
    ]);

    $allComments = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $allComments;
}

/**
 * Returns comments by id
 * 
 * @param PDO $pdo
 * @param int $commentId
 * 
 * @return array
 */
function getCommentById(PDO $pdo, int $commentId): array
{
    $statement = $pdo->prepare("SELECT * FROM comments3 WHERE id = :id");

    $statement->execute([
        ":id" => $commentId
    ]);

    $comment = $statement->fetch(PDO::FETCH_ASSOC);

    return $comment;
}


/**
 * Returns post by id
 *
 * @param object $pdo
 * @param int $id
 * 
 * @return array
 */
function getPostById(PDO $pdo, int $id): array
{
    $statement = $pdo->prepare("SELECT * FROM posts WHERE id = :id");

    $statement->execute([
        ":id" => $id
    ]);

    $post = $statement->fetch(PDO::FETCH_ASSOC);

    return $post;
}
