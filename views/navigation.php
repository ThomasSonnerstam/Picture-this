<nav>
    <a class="title" href="#"><?php echo $config['title']; ?></a>

    <ul class="menu">
        <li>
            <a href="/index.php">Home</a>
        </li>

        <li>
            <a href="/about.php">About</a>
        </li>

        <?php if (isset($_SESSION["user"])) : ?>

            <li>
                <a href="app/users/logout.php">Logout</a>
            </li>

        <?php else : ?>
            <li>
                <a href="/login.php">Login</a>
            </li>
        <?php endif; ?>


    </ul>
</nav>