<?php

require __DIR__ . '/views/header.php';
require __DIR__ . '/app/users/showbiography.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

?>

<!-- PROFILE INFORMATION -->
<section class="profile-info">

    <img class="profile-picture" src="/app/profile-pictures/pikachu.png" alt="">
    <h3>
        <?php echo $_SESSION["user"]["name"]; ?>
    </h3>
    <form class="biography-wrapper" action="/app/users/account.php" method="post">

        <textarea placeholder="Write your biography here" class="biography" name="biography" cols="30" rows="10">
            <?php echo $biography["biography"]; ?>
        </textarea>

        <?php if (isset($_SESSION["bioTooLong"])) : ?>
            <p class="error">
                <?php echo $_SESSION["bioTooLong"]; ?>
                <?php unset($_SESSION["bioTooLong"]); ?>
            </p>
        <?php endif; ?>

        <button type=" submit">
            Update bio
        </button>

    </form>

</section>

<!-- EDIT ACCOUNT SETTINGS -->
<section class="edit-account">

    <h2>Change email</h2>

    <?php if (isset($_SESSION["emailChanged"])) : ?>
        <p class="success">
            <?php echo $_SESSION["emailChanged"]; ?>
            <?php unset($_SESSION["emailChanged"]); ?>
        </p>
    <?php endif; ?>

    <form action="/app/users/account.php" method="post">

        <label for="email">Your current email</label>
        <input type="email" name="email" id="email">

        <?php if (isset($_SESSION["emailClash"])) : ?>
            <p class="error">
                <?php echo $_SESSION["emailClash"]; ?>
                <?php unset($_SESSION["emailClash"]); ?>
            </p>
        <?php endif; ?>

        <label for="emailnew">New email</label>
        <input type="email" name="emailnew" id="emailnew">

        <?php if (isset($_SESSION["emailIsSame"])) : ?>
            <p class="error">
                <?php echo $_SESSION["emailIsSame"]; ?>
                <?php unset($_SESSION["emailIsSame"]); ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_SESSION["emailAlreadyExists"])) : ?>
            <p class="error">
                <?php echo $_SESSION["emailAlreadyExists"]; ?>
                <?php unset($_SESSION["emailAlreadyExists"]); ?>
            </p>
        <?php endif; ?>

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

</section>

<script src="/assets/scripts/account.js"></script>

<?php require __DIR__ . '/views/footer.php';
