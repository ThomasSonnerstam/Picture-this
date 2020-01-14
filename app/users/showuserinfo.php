<?php

declare(strict_types=1);

// Queries to be able to extract info from database, this file is required in 
// files where you need information from the database.

if (isset($_SESSION["user"]["id"])) {

    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $biographyQuery = $pdo->prepare("SELECT biography FROM users WHERE id = :id");

    $biographyQuery->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $biography = $biographyQuery->fetch(PDO::FETCH_ASSOC);

    // Your posts
    $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :id ORDER BY id DESC");
    $statement->execute([
        ":id" => $user["id"]
    ]);
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
}
