<?php
if (isset($_POST['categorie']) AND isset($_POST['titre']) AND isset($_POST['texte'])){
    include('../php/verif_article.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un article</title>
	<link rel ="stylesheet" media="screen and (min-width:721px)" href="../style/index.css" />
    <link rel ="stylesheet" media="screen and (max-width:720px)" href="../style/index_mobile.css" />
</head>
<div class="conteneur">
	<header>
    	<h1 style="text-align: center;">Ajouter un article</h1>
    </header>
    <div class="blocSeul">
    	<ul class="menu_horizontal">
	    	<li><a href="../controller/ctrlNews.php"><input type="submit" value="Mes news"></a></li>
	    	<li><a href="../index.php"><input type="submit" value="Annuler"></a></li>
		</ul>
	</div>
</div>
<body> 
<div class="formAjoutArticle">
	<form method="post" action="#" id="myformAjoutArticle">
		<p>
			<label for="categ">Thème: </label> 
			<select name="categorie" required="" id="categ">
				<option value="">--Choisissez une catégorie</option>
				<?php
				while ($donnees = $req->fetch()) {
				?>
				<option>
			  		<?php echo $donnees['description'] ?>
				</option>
				<?php
				}         
				?>
				</select><br /><br /></p>
		<p><label for="title">Titre: </label> <input type="text" name="titre" required="" id="title"><br/><br /></p>
		<label for="txt">Texte: </label><br />
				<textarea name="texte" id="txt" rows="10" cols="50" required=""></textarea><br/>

		<input type="submit" name="publier" value="Publier l'article">
		
	</form>
</div>
</body>
</html>