<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["oldpassword"], $_POST["password"], $_POST["passwordrepeat"])) {
    $oldPassword = password_hash($_POST["oldpassword"], PASSWORD_DEFAULT);
    $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $newPasswordRepeat = password_hash($_POST["passwordrepeat"], PASSWORD_DEFAULT);

    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->execute([
        "id" => $_SESSION["user"]["id"]
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $oldPasswordInfo = $user["password"];

    if ($oldPasswordInfo === $oldPassword && $newPassword === $newPasswordRepeat && $newPassword !== $oldPassword) {
        $changeQuery = $pdo->prepare("UPDATE users SET password = :newpassword WHERE id = :id");
        $changeQuery->execute([
            ":newpassword" => $newPassword,
            ":id" => $_SESSION["user"]["id"]
        ]);

        redirect("/logout.php");
    } else {
        die(var_dump($pdo->errorInfo()));
    }
}
