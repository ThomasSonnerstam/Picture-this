<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$_SESSION["message"] = [
    "created" => "You have successfully created an account!"
];

if (isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"])) {
    // Input variables and sanitation
    $firstName = trim(filter_var($_POST["firstname"], FILTER_SANITIZE_STRING));
    $lastName = trim(filter_var($_POST["lastname"], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $statement = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)");
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->execute([
        ":firstname" => $firstName,
        ":lastname" => $lastName,
        ":email" => $email,
        ":password" => $password
    ]);

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute(
        [
            ":email" => $email
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
