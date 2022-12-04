
<div class="drodown topbar"id="user-dropdown">
    <div id="content">
        <ul>
            <li><a href="?action=profil"><?= isset($_SESSION['mailU']) ? getUsernameByMailU($_SESSION["mailU"]) : "" ?></a></li>
            <li><a href="?action=profil">Mon compte</a></li>
            <li><a href="?action=commandes">Mes commandes</a></li>
            <li><a href="?action=deconnexion">Déconnexion</a></li>
        </ul>
    </div>
</div>