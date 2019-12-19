<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (isset($_POST["deletepost"])) {
    $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $statement->execute([
        ":id" => $_GET["id"]
    ]);
}


redirect('/');
