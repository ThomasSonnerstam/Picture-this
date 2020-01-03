<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.


if (isset($_POST["deletepost"])) {

    // Deletes the post
    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $statement->execute([
        ":id" => $_GET["id"]
    ]);

    // Deletes the like from the deleted post
    $statement = $pdo->prepare("DELETE FROM reactions WHERE post_id = :post_id");
    $statement->execute([
        ":post_id" => $_GET["id"]
    ]);

    // Removes the image from the deleted post
    $statement = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $statement->execute([
        ":id" => $_GET["id"]
    ]);
    $postInfo = $statement->fetch(PDO::FETCH_ASSOC);
    // die(var_dump($postInfo));
    $postInfoImage = $postInfo["image"];
    $fullPath = "/uploads/posts/$postInfoImage";
    unlink($fullPath);
}

redirect('/');
