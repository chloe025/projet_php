<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Projet ProgWeb</title>
        <link rel ="stylesheet" media="screen and (min-width:721px)" href="style/index.css" />
        <link rel ="stylesheet" media="screen and (max-width:720px)" href="style/index_mobile.css" />
    </head>
    <body>
        <a id="bouton" href="#">Retour en haut de la page </a>
        <!-- On fait un contenneur pour englober le header, le menu utilisateur et les zones de recherche -->
        <div class="conteneur">
        <header>
            <h1 style="text-align: left;">Les nouvelles du jour !</h1>
        </header>
        <!-- bloc qui contient le menu utilisateur et les zones de recherche -->
        <div class="blocDouble">
            <!-- menu utilisateur -->
            <div class="menu">
                <ul class="menu_horizontal">
                    <?php 
                    if (isset($_SESSION['id_user'])){
                    ?>
                
                    <li><a href="controller/ctrlNews.php"><input type="submit" value="Mes news"></a></li>
                    <li><a href="controller/ctrl.php"> <input type="submit" value="Mon compte"></a></li>

                    <?php
                    }
                    else { 
                    ?>
                    <li></li>
                    <li><input type="submit" value="Se connecter" onclick="openForm();"></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- menu de recherche -->
            <div class="recherche">
                <form class="formul_rech" method="post" action="#" >
                    <div>
                        <legend style="text-decoration: underline;">Recherches : </legend>
                        <label for="auteur">Par auteur : </label><input type="search" name="auteur" id="auteur"> <br/>
                        <hr style=" border: none;">
                        <label for="title">Par titre : </label><input type="search" name="title" id="title"><br/>
                        <label>Trier par thème :</label> 
                            <select name="categorie" id="categ">
                                <option value="">--Choisissez une catégorie</option>
                                <?php
                                   while ($donnees = $req1->fetch()) {
                                ?>
                                <option>
                                      <?php echo $donnees['description'] ?>
                                </option><?php
                                    }  
                                ?>   
                            </select>

                    </div>
                    <div>
                        <legend style="text-decoration: underline;">Trier par : </legend>
                        <label>Date : </label><br>
                        <div class="decal">
                            Plus récent <input type="radio" name="triDate" value="decroissant" checked="">
                            Plus ancien <input type="radio" name="triDate" value="croissant">
                        </div>
                        <br>
                        <label>Trier par titre : </label><br>
                        <div class="decal">
                            Alphabétique A-Z<input type="radio" name="triTitre" value="croissant" checked="">
                            Alphabétique Z-A<input type="radio" name="triTitre" value="decroissant">                    
                        </div>
                        
                    </div>
                    <input type="submit" name="Valider">
                </form>
            </div>
        </div>
        </div>
        <!-- zone des articles -->
        <section>
            <?php  
                while ($donnees = $req2->fetch()) {
            ?>
                <article>
                    <div id="info_art1">
                        <h2><?php echo $donnees['titrenews'] ?></h2>
                        <h3 id="info_art2"><?php echo $donnees['nom']. " ". $donnees['prenom'] ." le ". $donnees['datenews']?></h3>
                    </div>
                    <h3 style="font-size: 14px">Thème : <?php echo $donnees['description']?></h3>
                    <hr>
                    <br/>
                    <p>
                        <?php
                            echo $donnees['textenews'];
                        ?>
                    </p>
                </article>
                <?php
                }
                ?>
        </section>

    <div class="login-popup">
        <div class="form-popup" id="popupForm">
            <form method ="post" action ="php/verif_connexion.php" class="form-container">
                <h2>Veuillez vous connecter</h2>
                <div class="co">
                    <label for="mailC">
                        <strong>E-mail</strong>
                    </label>
                    <input type="text" id="mailC" placeholder="Votre Email" name="mailC" required>
                    <label for="mdpC">
                        <strong>Mot de passe</strong>
                    </label>
                    <input type="password" id="mdpC" placeholder="Votre Mot de passe" name="mdpC" required>
                </div>
                <button type="submit" class="btn">Connecter</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
                <input type="submit" value="Pas encore inscrit ?" onclick="openInscripForm()">
            </form>
    </div>

    <div class="form-popup" id="popupFormIns">
        <form method="post" action="php/verif_creation.php" class="form-container">
            <h2>Formulaire d'inscription</h2>
            <div class="co">
                <label for="nom">
                    <strong>Nom</strong>
                </label>
                <input type="text" id="nom" placeholder="Votre nom" name="nom" required>
                <label for="prenom">
                    <strong>Prénom</strong>
                </label>
                <input type="text" id="prenom" placeholder="Votre prénom" name="prenom" required>
                <label for="mail">
                    <strong>Votre email</strong>
                </label>
                <input type="text" id="mmail" placeholder="Votre e-mail" name="mail" required>
                <label for="mdp">
                    <strong>Mot de passe</strong>
                </label>
                <input type="password" id="mdp" placeholder="Votre Mot de passe" name="mdp" required>
                <label for="mdp2">
                    <strong>Confirmez votre mot de passe</strong>
                </label>
                <input type="password" id="mdp2" name="mdp2" required>
            </div>
            <button type="submit" class="btn">S'inscire</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
            <input type="submit" value="Déjà inscrit ?" onclick="openForm()">
        </form>
    </div> 
    <script>
        function openForm() {
            document.getElementById("popupForm").style.display="block";
            document.getElementById("popupFormIns").style.display="none";
        }

        function closeForm() {
            document.getElementById("popupForm").style.display="none";
            document.getElementById("popupFormIns").style.display="none";
        }
        function openInscripForm(){
            document.getElementById("popupForm").style.display="none";
            document.getElementById("popupFormIns").style.display="block";
        }
    </script>
</body>
</html>