<nav>
    <img src="/assets/images/ptlogo.png" alt="The Picture This image">

    <ul class="menu">

        <li>
            <a href="/index.php">Home</a>
        </li>

        <?php if (isset($_SESSION["user"])) : ?>

            <li>
                <a class="login" href="/profile.php">Profile</a>
            </li>

        <?php else : ?>

            <li>
                <a href="/signup.php">Sign Up</a>
            </li>

            <li>
                <a href="/login.php">Log in</a>
            </li>
        <?php endif; ?>

    </ul>

    <?php if (isset($_SESSION["user"])) : ?>
        <a class="settings-anchor" href="/account.php">
            <img class="settings-icon" src="/assets/images/settings.png" alt="Image of a cog wheel">
        </a>

    <?php endif; ?>

</nav>