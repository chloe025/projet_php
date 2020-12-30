<?php
include('../model/bdd_connexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon compte</title>
        <link rel ="stylesheet" media="screen and (min-width:720px)" href="../style/index.css" />
        <link rel ="stylesheet" media="screen and (max-width:720px)" href="../style/index_mobile.css" />
    </head>

    <body>
    	<div class="conteneur">
    		<header>
		    	<h1 style="text-align: center;">Mon compte</h1>
    		</header>
    		<div class="blocSeul">
    			<ul class="menu_horizontal">
    				<li><a href="../controller/ctrlNews.php"><input type="submit" value="Mes news"></a></li>
    				<li><a href='../index.php'><input type="submit" value="Retour à l'accueil"></a><br /></li>
    		</div>
    	</div>

    	<div id="informations">
    		<div id="choixInformations">
    			<div id="infoBtn">
					<input type='submit' name='infos' value='Mes infos'>
					<input type='submit' value='Déconnexion' onclick="openFormDeco();">
					<input type='submit' value='Supprimer mon compte' onclick="openFormSuppr();">
				</div>
    		</div>
    		<hr style="margin: 0;">
    		<div classe="afficheInformations">
    			<!-- On affiche les informations de l'utilisateur -->
    			<?php
				if((isset($_POST['infos'])) || ((!isset($_POST['infos']))) ){
					?>
					<div class="inforPerso">
						<h1>Informations personnelles: </h1>
						<?php
						$reponse->execute(array($_SESSION['id_user']));
						while ($donnees = $reponse->fetch()){
							?>
							<div style="display: flex; justify-content: space-between;">
								<span><label>Nom : </label> <?php echo $donnees['nom']; ?></span> <br>
					    		<span><label>Prénom : </label><?php echo $donnees['prenom']; ?></span> <br>
							</div>
					    	<span>
					    		<label>Adresse mail : </label><?php echo $donnees['adressemail']; ?>
					    	</span> 
					    	<?php
					    }
						?>
						<form style="display: flex; justify-content: center; padding: 15px;"method="post" action="#">
							<input type="submit" name="modif" value="Modifier mes informations">
						</form>
						<?php
				}
				?>
					</div>
					
				<?php
				if(isset($_POST['modif'])){
					if (isset($_POST['mdp2']) AND isset($_POST['mdp'])){
						// on retire les balises html si elles sont rentrées
						$_POST['mdp'] = htmlspecialchars($_POST['mdp']);
						$_POST['mdp2'] = htmlspecialchars($_POST['mdp2']);
						// si les mots de passe correspondent et sont inférieurs à 8 caractères
						if ($_POST['mdp'] == $_POST['mdp2'] && strlen($_POST['mdp']) < 8){
					    	$_POST['mail'] = htmlspecialchars($_POST['mail']);
					    	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])){
					 	   			include('modif_compte.php');
					    	}
					  		else
						        echo 'L\'adresse ' . $_POST['mail'] . ' n\'est pas valide, recommencez !';
						}
						else
							echo "les mots de passes ne correspondent pas";
					}
					?>
					<div id="infoModif">
						<hr style="margin: 0;">
						<h1 style="margin: 0;">Modifier mes informations</h1>
						<form method="post" action="php/modif_compte.php">
							<label class="decal">Nom :</label>	<input type="text" name="nom" required=""><br/>
							<label class="decal">Prénom :</label>	<input type="text" name="prenom" required=""><br/>
							<label class="decal">Mail :</label>	<input type="text" name="mail" required=""><br/>
							<label class="decal">Mot de passe :</label>	 <input type="password" name="mdp" required=""> <em>7 caractères maximum</em><br/>
							<label class="decal">Confirmez votre mot de passe :</label><input type="password" name="mdp2" required=""><br/>
							<input type='submit' name='valider' value='Enregistrer' style="display: flex; justify-content: center;"><br />
						</form>
					</div>
					

				<?php
				}
				?>
			</div>
    	</div>
				<div class="login-popup">
					 <div class="form-popup" id="popupFormDeco">
        				 <form method ="post" action ="" class="form-container">
			            	<h2>Voulez-vous vraiment vous déconnecter ?</h2>
			            		<button type="submit" class="btn" name="oui">Oui</button>
			        			<button type="button" class="btn cancel" onclick="closeForm()">Non</button>			        		
			        	</form>
					</div> 
				</div>

				<div class="login-popup">
					 <div class="form-popup" id="popupSuppr">
        				 <form method ="post" action ="" class="form-container">
			            	<h2>Voulez-vous vraiment supprimer votre compte ?</h2>
			            		<button type="submit" class="btn" name="okSuppr">Oui je souhaite supprimer</button>
			        			<button type="button" class="btn cancel" onclick="closeForm()">Non, j'ai changé d'avis</button>			        		
			        	</form>
					</div> 
				</div>
    		
    	<script>
    		function openFormDeco() {
            	document.getElementById("popupFormDeco").style.display="block";
            	document.getElementById("popupSuppr").style.display="none";
        	}
        	function closeForm(){
        		document.getElementById("popupFormDeco").style.display="none";
        		document.getElementById("popupSuppr").style.display="none";
        	}
        	function openFormSuppr(){
        		document.getElementById("popupFormDeco").style.display="none";
        		document.getElementById("popupSuppr").style.display="block";
        	}
    	</script>
	</body>
</html>

