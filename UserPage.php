<?php require 'header.php' ?>

<main class="d-flex m-4 border border-5 rounded user-card">
    <img src=" <?php echo $userManager->getByUsername($_SESSION["username"])->getProfilePicture() ?> " alt="" class="pfp">
    <div>
        <h1><?php echo $_SESSION["username"] ?></h1>
        <form method="post">
            <div class="input-group mb-3 change-user-data">
                <input type="text" class="form-control" placeholder="New Image URL" name="profilePicture">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="change-image">Change</button>
                </div>
            </div>
            <?php
            if ($_SESSION["username"] === "Admin") { //si lutilisateur connecte est l'admin, donne les droits de creer des cartes
            ?>
                <div>
                    <h2>Create new Card</h2>
                    <form> <!-- formulaire de creation de cartes -->
                        <label for="name">Card name</label><br>
                        <input type="text" name="name" id="name" placeholder="Card name"><br>
                        <label for="image">Card image</label><br>
                        <input type="text" name="image" id="image" placeholder="Card image"><br>
                        <label for="description">Card description</label><br>
                        <input type="text" name="description" id="description" placeholder="Card description"><br>
                        <label for="name">Card type</label><br>
                        <input type="text" name="category" id="category" placeholder="Card category"><br><br>
                        <input type="submit" value="Submit" name="card-submit">



                    </form>
                </div>
            <?php
            }
            ?>
            <div class="input-group mb-3 change-user-data"> <!-- suppression de compte -->
                <input class="btn btn-outline-danger" type="submit" name="delete-button" value="DELETE ACCOUNT">
            </div>

        </form>

        <?php
        if (isset($_POST['change-image'])) { // formulaire envoye pour changement d'image
            $userManager = new UserManager();
            $currentUser = $userManager->getByUsername($_SESSION["username"]);
            $updatedUser = $currentUser;
            if (htmlspecialchars($_POST["profilePicture"], ENT_QUOTES) !== '') {
                $updatedUser->setProfilePicture(htmlspecialchars($_POST["profilePicture"]), ENT_QUOTES);
            }
            $userManager->updateByUsername($currentUser);
        }
        if (isset($_POST['card-submit'])) { // formulaire envoye pour creation de carte
            $cardManager = new CardManager();
            $newCardInfos = [
                'name' => $_POST['name'],
                'image' => $_POST['image'],
                'description' => $_POST['description'],
                'category' => $_POST['category']
            ];
            var_dump($newCardInfos);
            $newCard = new Card($newCardInfos);
            $cardManager->create($newCard);
        }
        if (isset($_POST['delete-button'])) { // formulaire envoye pour suppression de compte
            $userManager = new UserManager();
            $currentUser = $_SESSION["username"];
            $userManager->deleteByUsername($currentUser);
            echo "<script>window.location.href='disconnect.php'</script>";
        }
        ?>
</main>

<?php require 'footer.php' ?>