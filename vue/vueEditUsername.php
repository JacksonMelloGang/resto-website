<?php

ob_start();

?>

    <div>
        <h1>Modifier le mot de passe</h1>
        <form action="./?action=updatePseudo" method="post">
            <table style="text-align: center">
                <tr>
                    <td><label for="mdpU">Votre pseudo:</label></td>
                    <td><?= $pseudo ?></td>
                </tr>
                <tr>
                    <td><label for="pseudoU">Votre nouveau pseudo:</label></td>
                    <td><input type="text" name="pseudoU" required></td>
                </tr>
                <tr>
                    <td colspan="1"><input type="submit" value="Modifier"></td>
                    <td><?php if(isset($msg)){ echo($msg);} ?></td>
                </tr>
            </table>
        </form>
    </div>

<?php

$content = ob_get_clean();
include 'vue\layout\layout.php';
