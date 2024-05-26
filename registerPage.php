<?php
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
    <title>Register</title>
</head>

<body>
    <main>
        <div class="mx-auto d-flex-column" style="width:fit-content;">
            <img src="./Assets/Images/logo.png" alt="Logo" onclick="window.location='./index.php'">
            <form method="post" class="form-group"> <!-- creation formulaire de connexion -->
                <input type="text" name="username" class="form-control" placeholder="Username"><br>
                <input type="password" name="password" class="form-control" placeholder="Password"><br>
                <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirm password"><br>
                <button type="submit" class="btn btn-success">Register</button>
            </form>
            <?php
            if ($_POST) {
                $userManager = new UserManager();



                function testAlreadyExistUser($userManager)
                {
                    $allUsersData = $userManager->getAll();
                    foreach ($allUsersData as $key) {
                        if ($_POST["username"] == $key->getUsername()) {
                            return true;
                        }
                    }
                    return false;
                }
                if ($_POST["username"] === '' || $_POST["password"] === "" || $_POST["passwordConfirm"] === "") { //different tests pour valider l'inscription
                    ?> <p class="text-white credential-error radius p-2 ">Please fill in all the fields.</p> <?php 
                } else if (testAlreadyExistUser($userManager) == true) {
                    ?> <p class="text-white credential-error radius p-2 ">This user already exists</p> <?php 
                } else if (htmlspecialchars($_POST["password"], ENT_QUOTES) != htmlspecialchars($_POST["passwordConfirm"], ENT_QUOTES)) {
                    ?> <p class="text-white credential-error radius p-2 ">Passwords don't match.</p> <?php 
                } else {

                    $formInfos = [
                        'username' => htmlspecialchars($_POST["username"], ENT_QUOTES),
                        'password' => htmlspecialchars($_POST["password"], ENT_QUOTES)
                    ];
                    $newUser = new User($formInfos); //creation du nouvel utilisateur
                    var_dump($newUser);
                    // $userManager->create($newUser); //enregistrement en base de donnee
                    // echo "<script>window.location.href='index.php'</script>";
                }
            }

            ?>

        </div>
    </main>