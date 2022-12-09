<?php

ob_start();

?>

    <h1>Mon profil</h1>

    <div style="margin-bottom: 10px">Mon adresse électronique : <?= $util["mailU"] ?></div>
    <div style="margin-bottom: 10px">Mon pseudo : <?= $util["pseudoU"] ?> <a href="index.php?action=editUsername">Modifier mon pseudo</a></div>
    <div>Mon mot de passe: ****** <a href="index.php?action=editPassword">Modifier mon mot de passe</a></div>
    <hr style="width: 99%">

    les restaurants que j'aime : <br />
    <?php for($i=0;$i<count($mesRestosAimes);$i++){ ?>
        <a href="./?action=showRestaurant&idR=<?= $mesRestosAimes[$i]["idR"] ?>"><?= $mesRestosAimes[$i]["nomR"] ?></a><br />
    <?php } ?>
    <hr style="width: 99%">
    les types de cuisine que j'aime :
    <ul id="tagFood">
    <?php for($i=0;$i<count($mesTypeCuisineAimes);$i++){ ?>
        <li class="tag"><span class="tag">#</span><?= $mesTypeCuisineAimes[$i]["libelleTC"] ?></li>
    <?php } ?>
    </ul>
    <hr style="width: 99%">
    <a href="./?action=disconnect" style="margin-bottom: 10px;background: rgb(45, 45, 45);color:white;padding:10px;border-radius:3px">se deconnecter</a>


<?php

$content = ob_get_clean();
include "vue\layout\layout.php";

?>