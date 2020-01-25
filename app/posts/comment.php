<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we add comments to the database.

if (isset($_POST['comment'])) {
    //die(var_dump($_POST));
    $userId = $_SESSION['user']['id'];
    $postId = $_GET['id'];
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('INSERT INTO comments3 (user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':user_id' => $userId,
        ':post_id' => $postId,
        ':comment' => $comment
    ]);

    redirect("/comment.php?id=$postId");
}
