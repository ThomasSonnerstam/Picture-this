<?php

declare(strict_types=1);

require __DIR__ . '/views/header.php';
?>

<section class="edit-account">

    <form action="/app/users/account.php" method="post">

        <label for="password">New Password</label>
        <input type="password" name="password" id="password">

        <label for="passwordrepeat">New Password</label>
        <input type="password" name="passwordrepeat" id="passwordrepeat">

        <button type="submit"></button>


    </form>


</section>

<?php require __DIR__ . '/views/footer.php';
