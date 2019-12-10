<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we login users.

// Checks if the email & password inputs have any text
if (isset($_POST["email"], $_POST["password"])) {
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $password = $_POST["password"];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute(
        [
            ":email" => $email
        ]
    );
    $users = $statement->fetch(PDO::FETCH_ASSOC);

    // Email and password from user database
    $userEmail = $users["email"];
    $userPassword = $users["password"];

    // If you enter an email that does not exist, you're redirected to 
    // the login page
    if ($email !== $userEmail) {
        redirect("/login.php");
    }

    if (password_verify($password, $userPassword)) {
        $_SESSION["user"] = [
            "id" => $users["id"],
            "name" => $users["first_name"],
            "email" => $users["email"]
        ];
        redirect("/");
    }
}
