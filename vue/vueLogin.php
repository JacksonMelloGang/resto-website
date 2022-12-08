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

<?php

/**
 * 
 * 
?>
    <!-- div element with transparent gray rounded cube as a background in the middle of the screen  -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Connexion</h1>
                <div class="account-wall">
                    <img class="profile-img" src="images/logo.png"
                        alt="">

                    <form class="form-signin" action="./?action=login" method="POST">
                        <input type="text" class="form-control" placeholder="Email" name="mailU" required autofocus>
                        <input type="password" class="form-control" placeholder="Password" name="mdpU" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                            Remember me
                        </label>
                        <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="./?action=vueInscription" class="text-center new-account">Create an account </a>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
include "vue/layout/blank.php"; // On inclut le layout

 * 
 * **/