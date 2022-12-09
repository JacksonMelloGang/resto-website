<nav>
    <div id="navcontent">
        <div id="navlogo">
            <img src="/resources/img/logoBarre.png">
        </div>
        <ul>
            <li><a href="?action=home">Accueil</a></li>
            <li><a href="?action=showRestaurants">Restaurants</a></li>
            <li><a href="?action=showMenus">Menu</a></li>


            <!--<li><a href="/contact.html">Connexion</a></li>-->
        </ul>
        
        <hr style="position:relative;width: 100%;margin-left:auto;padding-right:10%">
        
        <div id="login-navbar">
            <?php
            
            if(isLoggedOn()){ ?>
                <div id="navprofil">
                    <a href="?action=monProfil"><img src="/resources/img/profil.png"></a>
                    <a href="?action=disconnect"><img src="/resources/img/deconnexion.png"></a>
                </div>
            <?php } else{ ?>
                <div id="navprofil">
                    <a href="?action=showLogin"><img src="/resources/img/connexion.png"></a>
                    <a href="?action=showRegister"><img src="/resources/img/inscription.png"></a>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>