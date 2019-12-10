<?php

declare(strict_types=1);

require __DIR__ . '/views/header.php';
?>

<section class="edit-account">

    <h2>Change password</h2>
    <form action="/app/users/account.php" method="post">

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

<?php require __DIR__ . '/views/footer.php';
