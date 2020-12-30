<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mes news</title>
        <link rel ="stylesheet" media="screen and (min-width:721px)" href="../style/index.css" />
  		<link rel ="stylesheet" media="screen and (max-width:720px)" href="../style/index_mobile.css" />
    </head>
	<div class="conteneur">
    <header>

    	<h1 style="text-align: center;">Mes news</h1>

    </header>
    <div class="blocSeul">
		<ul class="menu_horizontal">
		    <li><a href="../controller/ctrl.php"><input type="submit" value="Mon compte"></a></li>
		    <li><a href="../index.php"><input type="submit" value="Retour à l'accueil"></a></li>
		</ul>
	</div>
	</div>
    <body>
    	<div class="formMesNews">
	    	<form method="post">
	    		<input type="button" onclick="window.location.href='../controller/ctrlAjoutArt.php'" value="Ajouter un article"></a>
	    		<input type="button" onclick="window.location.href='../controller/ctrlModifArt.php'" value="Modifier un article"></a>
	    		<input type="submit" name="supprimer" value="Supprimer un article">
	    	</form>
    	</div>
            <?php
            	if(isset($_POST['supprimer'])){
           	?>
            	   	<form method="post" action="#" id="suppNews">
					Choisissez l'article à supprimer :
					<select name="titre" required="">
						<option value=""></option>
						<?php
	   					while ($donnees = $req->fetch()) {
						?>
						<option><?php echo $donnees['titrenews'] ?></option>
						<?php
						}             
						?>
					</select><br /><br />
	
						<input type="submit" name="validersupp" value="Confirmer la suppression">
						<input type="button" onclick="window.location.href='mesnews.php'" value="Annuler">
					</form>

					<?php
				}
					
				while ($donnees = $req2->fetch()) {    
		            ?>
		            <section>
		                <article style="border: #d50909  1px solid">
		                    <h2><?php echo $donnees['titrenews'] ?></h2>
		                    <h3><?php echo $donnees['nom']. " ". $donnees['prenom'] ?></h3>
		                    <h3><?php echo $donnees['datenews'] ?></h3>

		                    <br/>
		                    <p><?php echo $donnees['textenews']; ?> </p>
		                </article>
		            </section>
		            <?php
		                } 
		          	?>
    </body>
</html>