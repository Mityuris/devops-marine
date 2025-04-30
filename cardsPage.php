<?php require 'header.php' ?>
<script src="./Assets/Scripts/cards.js"></script>

<main>
    <section class=" p-4 d-flex flex-wrap justify-content-around">
        <?php
        $cardManager = new CardManager();
        $cardsData = $cardManager->getAll();
        $counter = 0;
        ?>
<!--            <div class="card m-2 bg-secondary-subtle --><?php //echo $key->getCategory() ?><!-- " style="width:fit-content;"> <!-- creation carte avec description -->-->
<!--                <div class="row no-gutters">-->
<!--                    <div class="col-sm-5">-->
<!--                        <img class="card-img border border-2 rounded" src=--><?php //echo $key->getImage(); ?><!-->-->
<!--                    </div>-->
<!--                    <div class="col-sm-7">-->
<!--                        <div class="card-body">-->
<!--                            <h5 class="card-title"> --><?php //echo $key->getName(); ?><!-- </h5>-->
<!--                            <p class="card-text">--><?php //echo substr($key->getDescription(), 0, 30); ?><!--...</p>-->
<!--                            <a href="#" class="btn btn-secondary">View more</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        --><?php
//        }
//        while ($counter % 4 != 0) { //fix du offset potentiel
//            $counter++;
//        ?>
<!--            <div class="card border-white m-2" style="width:fit-content; opacity:0%;">-->
<!--                <div class="row no-gutters" style=" display:none;">-->
<!--                    <div class="col-sm-5">-->
<!--                        <img class="cardImg" src=--><?php //echo $key->getImage(); ?><!>-->
<!--                    </div>-->
<!--                    <div class="col-sm-7">-->
<!--                        <div class="card-body">-->
<!--                            <h5 class="card-title"> --><?php //echo $key->getName(); ?><!-- </h5>-->
<!--                            <p class="card-text">--><?php //echo substr($key->getDescription(), 0, 30); ?><!--...</p>-->
<!--                            <a class="btn btn-primary">View Profile</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        --><?php
//        }
//        ?>
    </section>

</main>
<?php require 'footer.php' ?>