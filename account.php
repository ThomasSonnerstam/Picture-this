<?php

require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showuserinfo.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

?>

<!-- PROFILE INFORMATION -->

<section class="profile-info">

    <?php if (isset($_SESSION["errors"])) : ?>
        <p class="error">
            <?php $errors = $_SESSION["errors"];
            foreach ($errors as $error) : ?>
                <?php echo $error; ?>
            <?php endforeach; ?>
            <?php unset($_SESSION["errors"]); ?>
        </p>
    <?php endif; ?>

    <img class="profile-picture" src="/uploads/avatars/<?php echo $user["profile_picture"]; ?>" alt="">

    <form class="pick-your-avatar" action="/app/users/account.php" enctype="multipart/form-data" method="post">
        <label for="avatar">Pick your avatar</label>
        <div class="avatar-wrapper">
            <label for="avatar">
                Choose image:
                <img src="/assets/images/index-logo.png" alt="Image of a camera">
            </label>
            <input type="file" accept="image/jpeg, image/png" name="avatar" id="avatar">
            <button type="submit">Upload</button>
        </div>
    </form>
    <h3>
        <?php echo $_SESSION["user"]["name"]; ?>
    </h3>

    <form class="biography-wrapper" action="/app/users/account.php" method="post">

        <textarea placeholder="Write your biography here" class="biography" name="biography" cols="30" rows="10"><?php echo $biography["biography"]; ?></textarea>

        <button type="submit">Update bio</button>

    </form>

</section>

<!-- EDIT ACCOUNT SETTINGS -->
<section class="edit-account">

    <h2>Change email</h2>

    <form action="/app/users/account.php" method="post">

        <label for="email">Your current email</label>
        <input type="email" name="email" id="email">

        <label for="emailnew">New email</label>
        <input type="email" name="emailnew" id="emailnew">

        <button type="submit">Change email</button>

    </form>

    <h2>Change password</h2>
    <form action="/app/users/account.php" method="post">

        <label for="oldpassword">Old password</label>
        <input type="password" name="oldpassword" id="oldpassword">

        <label for="password">New password</label>
        <input type="password" name="password" id="password">

        <label for="passwordrepeat">Repeat new password</label>
        <input type="password" name="passwordrepeat" id="passwordrepeat">

        <div class="account-buttons">
            <button type="submit">Reset password</button>

            <button class="logout">
                <a href="/app/users/logout.php">Log out</a>
            </button>
        </div>

    </form>

    <form action="/app/users/delete.php" method="post">

        <h2>Delete account</h2>
        <button class="logout delete-account" type="submit">Yes</button>

    </form>

</section>

<script src="/assets/scripts/account.js"></script>

<?php require __DIR__ . '/views/footer.php';
