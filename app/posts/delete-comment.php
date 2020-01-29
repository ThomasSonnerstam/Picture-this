<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete comments from the database.

if (isset($_POST['delete-comment'])) {
    $commentId = (int) $_GET['id'];
    $userId = $_SESSION['user']['id'];

    $statement = $pdo->prepare('DELETE FROM comments3 WHERE id = :commentId AND user_id = :userId');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ':commentId' => $commentId,
        ':userId' => $userId
    ]);

    redirect('/');
}
