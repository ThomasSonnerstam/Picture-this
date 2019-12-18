<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Update your biography

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
        $_SESSION["errors"][] = "Your biography has a max limit of 240 characters.";
        redirect("/account.php");
    }
}

// Upload an avatar image

if (isset($_FILES["avatar"])) {
    $files = $_FILES["avatar"];
    $date = date("ymd");
    $name = $files["name"];
    $destination = __DIR__ . "/../../uploads/avatars/$date-$name";
    $fullAvatarName = "$date-$name";

    if ($files["size"] > 4000000) {
        $_SESSION["errors"][] = "The file size is too big!";
    }

    move_uploaded_file($files["tmp_name"], $destination);

    $user = getUsersById($pdo);

    $userId = $user["id"];

    $statement = $pdo->prepare("UPDATE users SET profile_picture = :avatar WHERE id = :id");
    $statement->execute([
        ":avatar" => $fullAvatarName,
        ":id" => $userId
    ]);

    $_SESSION["errors"][] = "You have successfully uploaded your profile picture";

    redirect("/account.php");
}

// Change your email

if (isset($_POST["email"], $_POST["emailnew"])) {

    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $emailNew = trim(filter_var($_POST["emailnew"], FILTER_SANITIZE_EMAIL));

    // Gets data from currently logged in user
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $storedEmail = $user["email"];

    // Gets email from users table

    $statement = $pdo->prepare("SELECT email FROM users WHERE email = :email");
    $statement->execute([
        ":email" => $emailNew
    ]);
    $doesEmailExist = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($email !== $storedEmail) {
        $_SESSION["errors"][] = "This is not your current email address";
    } elseif ($email === $emailNew) {
        $_SESSION["errors"][] = "You can't change to the same email address";
    } elseif (!empty($doesEmailExist)) {
        $_SESSION["errors"][] = "This email already exists, pick another one!";
    } else {
        $statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
        $statement->execute([
            ":email" => $emailNew,
            ":id" => $_SESSION["user"]["id"]
        ]);
        $_SESSION["errors"][] = "Your email has successfully been changed!";
    }
    redirect("/account.php");
}

// Change your password

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
