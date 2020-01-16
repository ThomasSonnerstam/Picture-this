# PICTURE THIS

This project is a social media platform that is similar to Instagram.

# SCHEMA

This is the database layout

<img src="https://i.imgur.com/7N4upqa.png" width=80%>

# BUILT WITH

-   HTML
-   CSS
-   PHP
-   JavaScript
-   SQLite

# INSTALLATION

-   Download the latest version of PHP
-   Clone this repository with GitHub Desktop, your terminal, or anyway you can.
-   Open the folder in your code editor of choice.
-   Open your terminal, navigate to the cloned repository directory.
-   Open a local hosted server by typing `php -S localhost:XXXX` (replace XXXX by any digits).
-   Now you can navigate to your browser and type in `localhost:XXXX` and replace the X's with the digits you chose.
-   You can now sign up and log into your account. You're able to i.e. upload an avatar, biography and make posts among other things.

# PREVIEW

<img src="https://i.imgur.com/xPzdh1R.png" width=80%>
<img src="https://i.imgur.com/GinvkRY.png" width=80%>
<img src="https://i.imgur.com/x149csr.png" width=80%>

# TESTERS

-   [Andreas Lindberg](https://github.com/oaflindberg)
-   [Betsy Alva Soplin](https://github.com/milliebase)

# CODE REVIEW

(by [Dominic Kersch](https://github.com/AltDom))

-   app/users/account.php: L54 & L96 - These errors are successes. Consider using another variable \$\_SESSION[‘successes’] for your successful events.
-   functions.php: L26 - The “GetUsersByID” function accepts a PDO as an argument and not an ID. Consider a name such as “GetActiveUser”.
-   functions.php: L32 - If a problem occurs with the function “GetUsersByID” (e.g. if the request returns empty), \$user = [] is not handled.
-   app/users/account.php: L45 - Calling “GetUsersByID” here is not necessarily needed. The active user’s data can be retrieved directly from the session opened already in the autoload file. i.e. $user = $\_SESSION[“user”].
-   app/users/account.php: L59 - You could delete this line as you would overwrite $user in both or either of the following if statements (if their conditions are true). Alternatively, you could move it to the top of the page and remove $user definitions from all if statements.
-   app/users/account.php: L44 - Consider checking for a previously added avatar image, and remove it using unlink() if it exists.
-   app/users/signup.php: L48 - Consider checking for errors (and redirect accordingly) before inserting data into the database. Use if(!\$validatedEmail) etc.
-   footer.php: L2 - This line calls to a script which doesn’t exist.
-   account.php: L25 - This line triggers an error if $user[“profile-picture”] is not yet set. You could put this image tag inside an if($user[“profile-picture”]) statement to handle this case.
-   app/users/delete.php: L16 - \$userInfo[“profile-picture”] may not be set when the account is deleted. You could handle this with an if statement as above.

##test