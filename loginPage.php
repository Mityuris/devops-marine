<?php
session_start();
function loadClasses($class)
{
    require_once $class . ".php";
}

spl_autoload_register("loadClasses");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./Assets/Styles/login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <main>
        <div class="mx-auto d-flex-column" style="width:fit-content;">
            <img src="./Assets/Images/logo.png" alt="Logo" onclick="window.location='./index.php'">
            <form method="post" class="form-group"> <!-- creation formilaire de connexion -->
                <input type="text" name="username" class="form-control" placeholder="Username"><br>
                <input type="password" name="password" class="form-control" placeholder="Password"><br>
                <button type="submit" class="btn btn-success">Login</button>
            </form>

            <?php
            if ($_POST) {
                $userManager = new UserManager;
                $allUsersData = $userManager->getAll();
                $error = "";
                $goodUsername = "";
                foreach ($allUsersData as $userData) { // tests si infos valides
                    if ($_POST["username"] === '' || $_POST["password"] === "") {
                        $error = "Please fill in all the fields.";
                    } else if ($_POST["username"] === $userData->getUsername() && password_verify($_POST["password"], $userData->getPassword())) {
                        $goodUsername = $_POST["username"];
                    } else {
                        $error = "Wrong username or password.";
                    }
                }
                if ($goodUsername) {
                    $_SESSION["username"] = $goodUsername;
                    echo "<script>window.location.href='index.php'</script>";
                } else {
            ?> <p class="text-white credential-error radius p-2 "><?php $error; ?></p>
            <?php

                }
            }
            ?>

        </div>
    </main>