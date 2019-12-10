<?php

declare(strict_types=1);

require __DIR__ . '/views/header.php';

?>

<?php if (isset($_SESSION["user"])) : ?>

    <section class="edit-account">

        <h2>Change password</h2>
        <form action="/app/users/account.php" method="post">

            <label for="oldpassword">Old password</label>
            <input type="password" name="oldpassword" id="oldpassword">

            <label for="password">New Password</label>
            <input type="password" name="password" id="password">

            <label for="passwordrepeat">Repeat new Password</label>
            <input type="password" name="passwordrepeat" id="passwordrepeat">

            <div class="account-buttons">
                <button type="submit">Reset password</button>

                <button class="logout">
                    <a href="/app/users/logout.php">Log out</a>
                </button>
            </div>

        </form>

    </section>

<?php else : ?>

    <h2 class="must-log-in">Log in to see your account settings</h2>

<?php endif; ?>

<?php require __DIR__ . '/views/footer.php';
