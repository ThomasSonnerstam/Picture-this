<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we edit and delete posts in the database.

if (isset($_POST["editpost"])) {

    $edited = trim(filter_var($_POST["editpost"], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare("UPDATE posts SET content = :content WHERE id = :id");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->execute([
        ":content" => $edited,
        ":id" => $_GET["id"]
    ]);
}

redirect('/');
