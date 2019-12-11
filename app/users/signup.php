<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"])) {
    // Input variables and sanitation
    $firstName = trim(filter_var($_POST["firstname"], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST["lastname"], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $validatedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $statement = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)");
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    if ($validatedEmail) {
        $_SESSION["emailNotValid"] = "This email is not valid";
        $statement->execute([
            ":firstname" => $firstName,
            ":lastname" => $lastName,
            ":email" => $validatedEmail,
            ":password" => $password
        ]);

        $_SESSION["message"] = "You have successfully created an account!";
    } else {
        $_SESSION["emailNotValid"] = "This email is not valid";
        redirect("/signup.php");
    }

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");



    $statement->execute(
        [
            ":email" => $validatedEmail
        ]
    );

    $users = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION["user"] = [
        "id" => $users["id"],
        "name" => $users["first_name"],
        "email" => $users["email"]
    ];
    // createSessionUser($users);

    redirect("/");
}
