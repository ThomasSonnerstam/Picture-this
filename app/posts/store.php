<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.

if (isset($_FILES["newpost"], $_POST["caption"])) {

    $files = $_FILES["newpost"];
    $caption = trim(filter_var($_POST["caption"], FILTER_SANITIZE_STRING));
    $date = date("ymd");
    $name = $files["name"];
    $destination = __DIR__ . "/../../uploads/posts/$date-$name";
    $postImageName = "$date-$name";

    if ($files["size"] > 4000000) {
        $_SESSION["errors"][] = "The file size is too big!";
        redirect("/index.php");
    }

    $user = getUsersById($pdo);

    if (strlen($caption) <= 200) {
        $statement = $pdo->prepare("INSERT INTO posts (user_id, image, content) VALUES (:id, :image, :content)");
        $statement->execute([
            ":id" => $user["id"],
            ":image" => $postImageName,
            ":content" => $caption
        ]);

        move_uploaded_file($files["tmp_name"], $destination);
    } else {
        $_SESSION["errors"][] = "Your caption can only be 200 characters or less.";
    }
}

redirect('/');
