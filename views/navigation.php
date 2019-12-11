<nav>
    <img src="/assets/images/ptlogo.png" alt="The Picture This image">

    <ul class="menu">

        <li>
            <a href="/index.php">Home</a>
        </li>

        <li>
            <a href="/about.php">About</a>
        </li>

        <?php if (isset($_SESSION["user"])) : ?>

            <li>
                <a class="login" href="/account.php">Account</a>
            </li>

        <?php else : ?>

            <li>
                <a href="/signup.php">Sign Up</a>
            </li>

            <li>
                <a class="login" href="/login.php">Log in</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>