<?php

require __DIR__ . '/views/header.php';

if (!isset($_SESSION["user"])) {
    redirect("/");
}

?>

<section class="profile-info">

    <img class="profile-picture" src="/app/profile-pictures/pikachu.png" alt="">
    <h3>
        <?php echo $_SESSION["user"]["name"]; ?>
    </h3>
    <div class="biography-wrapper">
        <textarea class="biography" maxlength="240" name="" id="" cols="30" rows="10">


        </textarea>
        
        <button>
            Update bio
        </button>
    </div>




</section>

<section class="edit-account">

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

<?php require __DIR__ . '/views/footer.php';
