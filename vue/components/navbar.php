<nav>
    <div id="navcontent">
        <div id="navlogo">
            <img src="/images/logoBarre.png">
        </div>
        <ul>
            <li><a href="?action=accueil">Accueil</a></li>
            <li><a href="?action=accueil">Restaurants</a></li>
            <li><a href="?action=menu">Menu</a></li>


            <!--<li><a href="/contact.html">Connexion</a></li>-->
        </ul>
        
        <hr style="position:relative;width: 100%;margin-left:auto;padding-right:10%">
        
        <div id="login-navbar">
            <?php
            
            if(isLoggedOn()){
                echo '<div id="navprofil">
                <a href="?action=profil"><img src="/images/profil.png"></a>
                <a href="?action=deconnexion"><img src="/images/deconnexion.png"></a>
                </div>';
            } else{
                echo '<div id="navprofil">
                <a href="?action=connexion"><img src="/images/connexion.png"></a>
                <a href="?action=inscription"><img src="/images/inscription.png"></a>
                </div>';
            }
            
            ?>
        </div>

    </div>
</nav>