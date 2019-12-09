<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we logout users.

// Empties the session array
unset($_SESSION['user']);

// Ends the session
session_destroy();

redirect("/");
