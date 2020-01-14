<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"])) {
    // Input variables, validation and sanitation
    $firstName = trim(filter_var($_POST["firstname"], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST["lastname"], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $validatedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $getEmailQuery = $pdo->prepare("SELECT * FROM users WHERE email = :email");

    $getEmailQuery->execute(
        [
            ":email" => $validatedEmail
        ]
    );

    $users = $getEmailQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($users === [] && $validatedEmail) {
        $statement = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)");
        $statement->execute([
            ":firstname" => $firstName,
            ":lastname" => $lastName,
            ":email" => $validatedEmail,
            ":password" => $password
        ]);

        $createdUser = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $createdUser->execute([
            ":email" => $validatedEmail
        ]);

        $createdUserData = $createdUser->fetch(PDO::FETCH_ASSOC);

        $_SESSION["user"] = [
            "id" => $createdUserData["id"],
            "name" => $createdUserData["first_name"],
            "email" => $createdUserData["email"]
        ];

        redirect("/");
    } elseif (!empty($users)) {
        $_SESSION["errors"][] = "This mail already exists in our database.";
        redirect("/signup.php");
    } else {
        $_SESSION["errors"][] = "This email is not valid";
        redirect("/signup.php");
    }
}

redirect("/");
