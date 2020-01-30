<nav>

    <img src="/assets/images/ptlogo.png" alt="The Picture This image">

    <ul class="menu">
        <li>
            <a href="/index.php" class="<?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>">Home</a>
        </li>

        <li>
            <a href="/explore.php" class="<?php echo $_SERVER['SCRIPT_NAME'] === '/explore.php' ? 'active' : ''; ?>">Explore</a>
        </li>

        <?php if (isset($_SESSION["user"])) : ?>
            <li>
                <a class="login <?php echo $_SERVER['SCRIPT_NAME'] === '/profile.php' ? 'active' : ''; ?>" href="/profile.php">Profile</a>
            </li>
        <?php else : ?>
            <li>
                <a href="/signup.php" class="<?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>">Sign Up</a>
            </li>

            <li>
                <a href="/login.php" class="<?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>">Log in</a>
            </li>
        <?php endif; ?>
    </ul>

    <?php if (isset($_SESSION["user"])) : ?>
        <a class="settings-anchor" href="/account.php">
            <img class="settings-icon" src="/assets/images/settings.png" alt="Image of a cog wheel">
        </a>

    <?php endif; ?>

</nav>