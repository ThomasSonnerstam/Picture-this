<?php

// Always start by loading the default application setup.

require __DIR__ . '/../app/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $config['title']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css@11.0.0/sanitize.css">
    <link rel="shortcut icon" href="/assets/images/ptlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/styles/nav.css">
    <link rel="stylesheet" href="/assets/styles/main.css">
    <link rel="stylesheet" href="/assets/styles/homepage.css">
    <link rel="stylesheet" href="/assets/styles/login.css">
    <link rel="stylesheet" href="/assets/styles/signup.css">
    <link rel="stylesheet" href="/assets/styles/account.css">
    <link rel="stylesheet" href="/assets/styles/profile.css">
    <link rel="stylesheet" href="/assets/styles/editpost.css">
    <link rel="stylesheet" href="/assets/styles/userprofile.css">
    <link rel="stylesheet" href="/assets/styles/comment.css">
    <link rel="stylesheet" href="/assets/styles/edit-comment.css">
</head>

<body>
    <?php require __DIR__ . '/navigation.php'; ?>