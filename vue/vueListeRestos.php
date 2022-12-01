<h1>Restaurant en Tendance</h1>
<?php
    for($i = 0; $i < count($restotendances); $i++) {

        $lesPhotos = getPhotosByIdR($restotendances[$i]['idR']);
        if (count($lesPhotos) > 0) {
            $photo = $lesPhotos[0];
        } else {
            $photo = array("idP" => 0, "idR" => $restotendances[$i]['idR'], "cheminP" => "default.jpg");
        }
?>
    <div class="card">
        <div class="photoCard">
            <img src="photos/<?= $photo["cheminP"] ?>">
        </div>

        <div class="descrCard">
            <a href='./?action=detail&idR=<?= $restotendances[$i]['idR'] ?> '> <?= $restotendances[$i]['nomR'] ?></a>
            <br />
            <?= $restotendances[$i]["numAdrR"] ?>
            <?= $restotendances[$i]["voieAdrR"] ?>
            <br />
            <?= $restotendances[$i]["cpR"] ?>
            <?= $restotendances[$i]["villeR"] ?>
        </div>
    </div>

<?php
    }
?>





<h1>Liste des restaurants</h1>

<?php
for ($i = 0; $i < count($listeRestos); $i++) {

    $lesPhotos = getPhotosByIdR($listeRestos[$i]['idR']);
    ?>

    <div class="card">
        <div class="photoCard">
            <?php if (count($lesPhotos) > 0) { ?>
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
            <?php } ?>


        </div>
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $listeRestos[$i]['idR'] . "'>" . $listeRestos[$i]['nomR'] . "</a>"; ?>
            <br />
            <?= $listeRestos[$i]["numAdrR"] ?>
            <?= $listeRestos[$i]["voieAdrR"] ?>
            <br />
            <?= $listeRestos[$i]["cpR"] ?>
            <?= $listeRestos[$i]["villeR"] ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">		


            </ul>


        </div>

    </div>





    <?php
}
?>


