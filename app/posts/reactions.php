<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["like"])) {

    $statement = $pdo->prepare("INSERT INTO reactions (user_id, post_id, reaction_type) VALUES (:user_id, :postId, 1)");

    $statement->execute([
        ":user_id" => $_SESSION["user"]["id"],
        ":postId" => $_POST["postId"]
    ]);

    redirect("/profile.php");
}
