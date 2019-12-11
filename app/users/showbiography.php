<?php

declare(strict_types=1);

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
