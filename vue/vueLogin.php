<h1>Connexion</h1>
<span id="alerte"><?= $msg ?></span>

<form action="./?action=connect" method="POST">
    <input type="text" name="mailU" placeholder="Email de connexion" /><br />
    <input type="password" name="mdpU" placeholder="Mot de passe"  /><br />
    <input type="submit" />

</form>
<br />
<a href="./?action=inscription">Inscription</a>

<hr>
Utilisateur de test : <br />
login : test@bts.sio<br />
mot de passe : sio

