<?php

declare(strict_types=1);

require __DIR__ . '/views/header.php';

?>


<section class="signup-wrapper">

    <h1 class="signup-h1">Welcome to Picture This!</h1>

    <p>
        Fill in the form to create your first Picture This account!
        <br>
        Join millions of people and interact with eachother!
    </p>

    <form action="/app/users/signup.php" method="post">

        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

    </form>

</section>




<?php require __DIR__ . '/views/footer.php'; ?>