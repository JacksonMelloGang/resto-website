<?php

ob_start();

?>

<div>
    <form action="index.php?action=editCritique" method="POST" style="position:relative; margin-left: 40%;margin-bottom: 10px;margin-top: 10px">
        <label for="note">Note</label>
        <select name="note" id="note">
            <option value="1" <?php if($critique['note'] == 1) echo "selected"; ?>>1</option>
            <option value="2" <?php if($critique['note'] == 2) echo "selected"; ?>>2</option>
            <option value="3" <?php if($critique['note'] == 3) echo "selected"; ?>>3</option>
            <option value="4" <?php if($critique['note'] == 4) echo "selected"; ?>>4</option>
            <option value="5" <?php if($critique['note'] == 5) echo "selected"; ?>>5</option>
        </select>
        <br><br>
        <label for="commentaire">Commentaire</label><br>
        <textarea style="resize: none;width: 20%;" name="commentaire" id="commentaire" cols="500" rows="3"><?=$critique['commentaire']?></textarea>
        <br>

        <input type="hidden" name="idR" value="<?= $_GET['idR'] ?> ">
        <input style="margin-top: 10px" type="submit" value="Ajouter">
    </form>
    <?php  if(isset($msg)){ echo($msg);} ?>
</div>

<?php

$content = ob_get_clean();
include "vue/layout/layout.php";

?>
