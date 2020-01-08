<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (isset($_POST["deletepost"])) {

    // Removes the image from the deleted post
    $statement = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
    $statement->execute([
        ":id" => $_GET["id"],
        ":user_id" => $_SESSION["user"]["id"]

    ]);
    $postInfo = $statement->fetch(PDO::FETCH_ASSOC);
    $postInfoImage = $postInfo["image"];
    $fullPath = __DIR__ . "/../../uploads/posts/$postInfoImage";
    unlink($fullPath);

    // Deletes the post
    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id AND user_id = :user_id");
    $statement->execute([
        ":id" => $_GET["id"],
        ":user_id" => $_SESSION["user"]["id"]
    ]);

    // Deletes the like from the deleted post
    $statement = $pdo->prepare("DELETE FROM reactions WHERE post_id = :post_id AND user_id = :user_id");
    $statement->execute([
        ":post_id" => $_GET["id"],
        ":user_id" => $_SESSION["user"]["id"]
    ]);
}

redirect('/');
