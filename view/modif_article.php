<?php
if (isset($_POST['titre']) AND isset($_POST['texte'])){
    include('../php/verif_modif_article.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modifier un article</title>
	<link rel ="stylesheet" media="screen and (min-width:721px)" href="../style/index.css" />
    <link rel ="stylesheet" media="screen and (max-width:720px)" href="../style/index_mobile.css" />
</head>
<div class="conteneur">
	<header>
    	<h1 style="text-align: center;">Modifier un article</h1>
    </header>
    <div class="blocSeul">
    	<ul class="menu_horizontal">
	    	<li><a href="../controller/ctrlNews.php"><input type="submit" value="Mes news"></a></li>
	    	<li><a href="../index.php"><input type="submit" value="Annuler"></a></li>
		</ul>
	</div>
</div>
<body>
<div class="formModifArticle">
	<form method="post" action="#">
		<p><label for="title">Choisissez le titre de l'article: </label> 
				<select name="titre" required="" id="title">
					<option value=""></option>
						<?php
							while ($donnees = $req->fetch()) {
						?>
					<option>
		  					<?php echo $donnees['titrenews'] ?>
					</option><?php
				}            
				?>
				</select></p><br />
		<p><label for="txt">Texte: </label><br />
		 <textarea name="texte" id="txt" rows="10" cols="50" required=""></textarea></p>

		<input type="submit" name="modifier" value="Enregistrer la modification">
	</form>
</div>
</body>
</html>