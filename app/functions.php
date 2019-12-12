<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
 * Function to create a $_SESSION["user"] - which means that the user is logged in
 *
 * @param int $id
 * @param string $name
 * @param string $email
 * @return void
 */
// function createSessionUser(array $users): array
// {
//     return [
//         "id" => $users["id"],
//         "name" => $users["name"],
//         "email" => $users["email"]
//     ];
// }


/**
 * Function to get the data from the current logged in user.
 *
 * @param object $pdo
 * @return array
 */
function getUsersById(object $pdo): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->execute([
        ":id" => $_SESSION["user"]["id"]
    ]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}

/**
 * Creates a message array
 *
 * @param string $errorName
 * @param string $errorContent
 * @return void
 */
// function createMessage(string $errorName, string $errorContent): void
// {
//     $_SESSION["$errorName"] = "$errorContent";
// }
