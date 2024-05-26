<?php
session_start();
function loadClasses($class) 
{
    require_once $class . ".php";
}

spl_autoload_register("loadClasses"); #auto-load des classes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isaac Four Souls Wiki</title>
    <link rel="stylesheet" type="text/css" href="./Assets/Styles/header.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c90f4286ee.js" crossorigin="anonymous"></script>
    <script src="./Assets/Scripts/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="p-3 d-flex justify-content-between top"> 
            <button id="burger" class="btn dflex" onclick="openSideBar()" style="color:white"> <!-- creation icone menu burger -->
                <i class="fa-solid fa-bars fa-3x"></i>
            </button>
            <img src="./Assets/Images/logo.png" alt="Logo" height="150px" onclick="window.location='./index.php'">

            <?php if ($_SESSION && $_SESSION["username"]) : ?> <!-- differe selon si connecté ou non -->
                <div class="d-inline-flex align-items-start"> <!-- acces compte si connecté -->
                    <div class="justify-content-">
                        <h4 class="text-white" onclick="window.location='./userPage.php'"><?= $_SESSION["username"] ?></h4>
                        <a href="./disconnect.php" class="link-underline-primary">Disconnect</a>
                    </div>
                    <?php
                    $userManager = new UserManager();
                    $userImage = $userManager->getByUsername($_SESSION["username"])->getProfilePicture();
                    ?>
                    <img src=" <?php echo $userImage ?>" alt="" class="pfp-small" onclick="window.location='./userPage.php'">
                </div>
            <?php else : ?>
                <div class="dropdown"> <!-- dropdown si pas login -->
                    <button class="btn d-inline-flex dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user fa-3x" style="color: white;"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" type="button" onclick="window.location='./loginPage.php'">Login</button></li>
                        <li><button class="dropdown-item" type="button" onclick="window.location='./registerPage.php'">Register</button></li>
                    </ul>
                </div>
            <?php endif ?>

        </div>

        <div id="sidebar" class="sidebar"> <!-- menu burger -->
            <a class="closebtn" onclick="closeSideBar()">
                <i class="fa-solid fa-xmark fa-3x " style="color: white;"></i>
            </a>
            <a href="./index.php" class="link">
                <h3>Home</h3>
            </a>
            <a href="./cardsPage.php" class="link">
                <h3>Cards</h3>
            </a>
        </div>
    </header>