
<div class="drodown topbar"id="user-dropdown">
    <div id="content">
        <ul>
            <li><a href="?action=monProfil"><?= isset($_SESSION['mailU']) ? getUsernameByMailU($_SESSION["mailU"]) : "" ?></a></li>
            <li><a href="?action=monProfil">Mon compte</a></li>
            <!--<li><a href="?action=commandes">Mes commandes</a></li>-->
            <li><a href="?action=disconnect">Déconnexion</a></li>
        </ul>
    </div>
</div>