<?php

declare(strict_types=1);

require __DIR__ . '/views/header.php';

?>

<section class="signup-wrapper">

    <h1 class="signup-h1">Create your account here!</h1>

    <p>
        Fill in the form to create your first Picture This account! Join millions of people and interact with eachother!
    </p>

    <form action="/app/users/signup.php" method="post">

        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" required>

        <?php if (isset($_SESSION["emailNotValid"])) : ?>
            <p class="error">
                <?php echo $_SESSION["emailNotValid"]; 
                unset($_SESSION["emailNotValid"]); ?>
            </p>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button class="create-account-button" type="submit">Create account</button>

    </form>

</section>

<?php require __DIR__ . '/views/footer.php'; ?>