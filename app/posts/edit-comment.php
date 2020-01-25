<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit comments in the database.

if (isset($_POST['edit-comment'])) {
    $editedComment = filter_var($_POST['edit-comment'], FILTER_SANITIZE_STRING);
    $commentId = (int) $_GET['id'];

    $statement = $pdo->prepare('UPDATE comments3 SET comment = :editedComment WHERE id = :commentId');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':editedComment' => $editedComment,
        ':commentId' => $commentId
    ]);

    $post = getCommentById($pdo, $commentId);
    $postId = $post['post_id'];

    redirect("/comment.php?id=$postId");
}
