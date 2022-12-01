<?php

ob_start();

if(isset($_SESSION["mailU"]) && isset($_SESSION["mdpU"])){
    include("components/topbar.php");
}

include("components/search_popup.php");

?>

<div class="row">
    <h1>Restaurant en tendances</h1>
    <div class="row-content">
        <?php
        for($i=0;$i<count($restostendance);$i++){
            ?>
            <div class="card">
                <div class="photoCard">
                    <img src="/photos/<?= $restostendance[$i]["cheminP"] ?>" alt="Photo du restaurant">
                </div>

                <div class="descrCard">
                    <h2><?= $restostendance[$i]["nomR"] ?></h2>
                    <p><?= $restostendance[$i]["descR"] ?></p>
                    <a href="?action=detail&idR=<?= $restostendance[$i]["idR"] ?>">Voir plus</a>
                </div>
            </div>
            <?php
        }
            ?>

    </div>
</div>

<div class="row">
    <h1>Liste des restaurants</h1>
    <div class="row-content">

        <?php
        foreach($restos as $resto){

            $photos = getPhotosByIdR($resto['idR']);
            if (count($photos) > 0) {
                $photo = $photos[0];
            } else {
                $photo = array("idP" => 0, "idR" => $restotendances[$i]['idR'], "cheminP" => "default.jpg");
            }
            
            ?>
            <div class="card">
                <div class="photoCard">
                    <img src="photos/<?= $photo["cheminP"]?>" alt="Photo du restaurant">
                </div>

                <div class="descrCard">
                    <h2><?= $resto["nomR"] ?></h2>
                    <p><?= $resto["descR"] ?></p>
                    <a href="?action=detail&idR=<?= $resto["idR"] ?>">Voir plus</a>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include "vue/layout/layout.php"; // On inclut le layout