<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST)) {

    // Deletes user
    $statement = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // Deletes likes
    $statement = $pdo->prepare('DELETE FROM reactions WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // Deletes posts
    $statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    // Deletes comments
    $statement = $pdo->prepare('DELETE FROM comments WHERE user_id = :id');
    $statement->execute([
        ':id' => $_SESSION['user']['id']
    ]);

    session_destroy();

    redirect('/');
}
