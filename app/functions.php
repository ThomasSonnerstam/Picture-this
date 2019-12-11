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
// function createSessionUser(int $id, string $name, string $email): void
// {
//     $_SESSION["user"] = [
//         "id" => $users[$id],
//         "name" => $users[$name],
//         "email" => $users[$email]
//     ];
// }
