<?php

ob_start();

if(isset($_SESSION["mailU"]) && isset($_SESSION["mdpU"])){
    include("components/topbar.php");
}

include("components/search_popup.php");

?>

<!-- RESTO NOM -->
<h1><?= $unResto['nomR']; ?></h1>

<!-- FOOD TAG -->
<ul id="tagFood" >		
        <?php for ($j = 0; $j < count($lesTypesCuisine); $j++) { ?>
            <li class="tag"><span class="tag">#</span><?= $lesTypesCuisine[$j]["libelleTC"] ?></li>
        <?php } ?>
</ul>

<!-- NOTE -->
<span id="note">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>" >
            <?php if ($i <= $noteMoy) { ?>
                <img class="note" src="resources/img/like.png" alt="">
            <?php } else {
                ?>
                <img class="note" src="resources/img/neutre.png" alt="line neutre">
            <?php } ?>
        </a>
    <?php } ?>
</span>


<!-- RESTO INFO CONTENT -->
<div style="display: flex; flex-direction: row;justify-content:center;text-align:center;width:70%;border: black 2px solid;border-radius:5px;">
    <img src="resources/photos/<?= $lesPhotos[0]["cheminP"]; ?>" alt="image du restaurant" style="width: 50%; object-fit: contain;">
    <div style="display:flex; flex-direction: column; text-align: center;width:70%;margin-left:10px;">
        <h2>Adresse</h2>
        <p><?php printf("%s, %s - %s, %s", $unResto['cpR'], $unResto['villeR'], $unResto['numAdrR'], $unResto['voieAdrR']); ?></p>
        <!-- google map search with query using api key-->
        <a href='https://www.google.com/maps/search/?api=1&query=<?= $unResto['nomR'] ?>, <?= $unResto['cpR'] ?>, <?= $unResto['villeR'] ?>'>Voir sur Google Maps</a>

        <br>
        <h2>Horaires</h2>
        <?= $unResto['horairesR']; ?>

        <!--
        <h2>Numéro de téléphone</h2>
        <p><?= $unResto['telephoneR']; ?></p>

        <h2>Site web</h2>
        <p><?= $unResto['siteWebR']; ?></p>
        -->
    </div>    
</div>
<div style="width:70%;">
    <h2>Description</h2>
    <p style="text-align:left;border: black 2px solid;border-radius:5px;padding: 10px;"><?= $unResto['descR']; ?></p>
</div>

<!-- RESTO PHOTO CAROUSSEL -->
<div style="width:70%;">
    <h2 id="photos">Photos</h2>
    <div style="height:auto;border: black 2px solid;border-radius:5px;padding: 10px;">
        <div class="slider">
            <div class="slide-track">
                <?php 
                    for ($i = 0; $i < count($lesPhotos); $i++) { 
                        echo("<div class='slide'> <img class='galerie' src='resources/photos/". $lesPhotos[$i]["cheminP"] . "' alt='' /></div>");
                    } 
                ?>
            </div>
        </div>
    </div>
</div>


    <?php if(isLoggedOn()){ ?>
        <?php if ($aimer !== false) { ?>
            <a href="./?action=aimerRestaurant&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="resources/img/aime.png" alt="j'aime ce restaurant"></a>
        <?php } else { ?>
            <a href="./?action=aimerRestaurant&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="resources/img/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
        <?php } ?>

    <?php } ?>

    <div style="width:70%;margin-bottom: 5%">
        <h2 id="crit">Plats Proposés</h2>

        <div style="border: black 2px solid;border-radius:5px;padding: 10px;">
            <?php
            if(count($lesPlats) != 0){
                for ($i = 0; $i < count($lesPlats); $i++) { ?>
                    <div style="border: red 2px solid; padding: 10px;" class="card">

                        <div>
                            <h3><?= $lesPlats[$i]["nomP"]; ?></h3>
                            <p><?= $lesPlats[$i]["descP"]; ?></p>
                            <p><?= $lesPlats[$i]["prixP"]; ?> €</p>
                        </div>
                    </div>
         <?php }
            } else {
                echo("<p>Aucun plat proposé pour le moment</p>");
            } ?>

        </div>
    </div>

<div style="width:70%;margin-bottom: 5%">
    <h2 id="crit">Critiques</h2>

    <div style="border: black 2px solid;border-radius:5px;padding: 10px;">
            <?php for ($i = 0; $i < count($critiques); $i++) { ?>
                <div style="border: red 2px solid; padding: 10px;">
                    <span style="position:relative;font-size: 22px;font-weight: bold;">
                        <?= $critiques[$i]["pseudoU"] ?> 
                    </span>
                    <div>
                        <span>
                            <?php
                            if ($critiques[$i]["note"]) {
                                echo $critiques[$i]["note"] . "/5";
                            }
                            ?>
                        </span>
                        <span><?= $critiques[$i]["commentaire"] ?> </span>
                        <br>
                        <span style="position:relative;margin-right:auto !important">
                            <?php
                                if($critiques[$i]["mailU"] == $mailU){
                                    echo "<a style='margin-right:10px;' href='./?action=showEditCritique&idR={$critiques[$i]["idR"]}'>Modifier</a>";
                                    echo "<a href='./?action=delCritique&idR=".$critiques[$i]["idR"]."'>Supprimer</a>";
                                }
                            ?>
                        </span>
                    </div>

                </div>
            <?php }

            if(isLoggedOn() && !$hasAlreadyCommented){?>
                <h2 id="crit">Ajouter une critique</h2>
                    <div style="border: black 2px solid;border-radius:5px;padding: 10px;">
                <form action="./?action=addCritique" method="post">
                    <label for="note">Note</label>
                    <select name="note" id="note">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br><br>
                    <label for="commentaire">Commentaire</label><br>
                    <textarea style="resize: none;width: 20%;" name="commentaire" id="commentaire" cols="30" rows="3" ></textarea>
                    <br>

                    <input type="hidden" name="idR" value="<?= $unResto['idR'] ?> ">
                    <input style="margin-top: 10px" type="submit" value="Ajouter">
                </form>
            </div>                
            <?php } else if(!isLoggedOn()) { ?>
                <br>
                <a href="index.php?action=showLogin">Envie de commenter ? Connecte toi</a>             
            <?php } ?> 
        </div>
</div>


<?php
$content = ob_get_clean();
include "vue/layout/layout.php"; // On inclut le layout