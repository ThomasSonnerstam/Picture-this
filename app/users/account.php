<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["oldpassword"], $_POST["password"], $_POST["passwordrepeat"])) {
    $oldPassword = $_POST["oldpassword"];
    $newPassword = $_POST["password"];
    $newPasswordRepeat = $_POST["passwordrepeat"];

    $user = getUsersById($pdo);

    $oldPasswordInfo = $user["password"];

    if (password_verify($oldPassword, $oldPasswordInfo) && $newPassword === $newPasswordRepeat && $newPassword !== $oldPassword) {
        $changeQuery = $pdo->prepare("UPDATE users SET password = :newpassword WHERE id = :id");
        $changeQuery->execute([
            ":newpassword" => password_hash($newPassword, PASSWORD_DEFAULT),
            ":id" => $_SESSION["user"]["id"]
        ]);

        redirect("/app/users/logout.php");
    } else {
        die(var_dump($pdo->errorInfo()));
    }
}

if (isset($_POST["biography"])) {

    $biographyText = trim(filter_var($_POST["biography"], FILTER_SANITIZE_STRING));

    $user = getUsersById($pdo);

    $storedBio = $user['biography'];

    $statement = $pdo->prepare("UPDATE users SET biography = :biography WHERE id = :id");

    if (strlen($biographyText) <= 240) {

        $statement->execute([
            ":biography" => $biographyText,
            ":id" => $_SESSION["user"]["id"]
        ]);

        redirect("/account.php");
    } else {
        $_SESSION["bioTooLong"] = "Your biography has a max limit of 240 characters.";
        redirect("/account.php");
    }
}
