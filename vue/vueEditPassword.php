<?php

ob_start();

?>

    <div>
        <h1>Modifier le mot de passe</h1>
        <form action="./?action=updateUserPassword" method="post">
            <table>
                <tr>
                    <td><label for="mdpU">Nouveau mot de passe</label></td>
                    <td><input type="password" name="mdpU" id="mdpU" required></td>
                </tr>
                <tr>
                    <td><label for="mdpU2">Confirmer le mot de passe</label></td>
                    <td><input type="password" name="mdpU2" id="mdpU2" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Modifier"></td>
                </tr>
            </table>
        </form>
    </div>

<?php

$content = ob_get_clean();
echo($content);
//include 'vue\layout\layout.php';
