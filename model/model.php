<?php
function getCategories(){
	include('bdd_connexion.php');
	$req1 = $bdd->query('SELECT description from theme');
	return $req1;
}

# tout les articles triés par date
function getArticlesFirstTime(){
	include('bdd_connexion.php');
	$req2 = $bdd->query('SELECT * from news, theme, redacteur WHERE redacteur.idredacteur=news.idredacteur AND theme.idtheme=news.idtheme ORDER BY datenews DESC');
	return $req2;
}
# liste des articles triés par ordre donné
function getArticles(){
	include('bdd_connexion.php');
	$sql = "SELECT * from news, theme, redacteur WHERE redacteur.idredacteur=news.idredacteur AND theme.idtheme=news.idtheme ".getTheme() .getOrder();
	$req2= $bdd->query($sql);
	return $req2;
}

# les articles triés par auteur
function getArticlesTriAuteur(){
	include('bdd_connexion.php');
	$auteur = htmlspecialchars($_POST['auteur']);
	$sql = "SELECT * FROM news,theme,redacteur WHERE redacteur.idredacteur = news.idredacteur AND theme.idtheme=news.idtheme AND (nom LIKE ? OR prenom LIKE ?)" .getTheme() . getOrder();
	$articles = $bdd->prepare($sql);
	$articles->execute(array("%$auteur%","%$auteur%"));
	
		return $articles;
}

# les articles triés par titre
function getArticlesTriTitle(){
	include('bdd_connexion.php');
	$titre = htmlspecialchars($_POST['title']);
	$sql = "SELECT * FROM news,theme,redacteur WHERE redacteur.idredacteur = news.idredacteur AND theme.idtheme=news.idtheme AND titrenews LIKE ?)" .getTheme() . getOrder();
	$articles = $bdd->prepare($sql);
	$articles->execute(array("%$titre%"));
	return $articles;
}

# les articles triés par auteur ET titre
function getArticlesTries(){
	include('bdd_connexion.php');
	$auteur = htmlspecialchars($_POST['auteur']);
	$titre = htmlspecialchars($_POST['title']);
	$sql = "SELECT * FROM news,theme,redacteur WHERE redacteur.idredacteur = news.idredacteur AND theme.idtheme=news.idtheme AND (nom LIKE ? OR prenom LIKE ?) AND titrenews LIKE ?".getTheme() . getOrder();
	$articles = $bdd->prepare($sql);
	$articles->execute(array("%$auteur%","%$auteur%", "%$titre%"));
	return $articles;
}

function getOrder(){
	if ($_POST['triDate'] == 'croissant' && $_POST['triTitre']=='croissant') $sql = " ORDER BY datenews ASC, titrenews ASC";
	if ($_POST['triDate'] == 'decroissant' && $_POST['triTitre']=='decroissant') $sql = " ORDER BY datenews DESC, titrenews DESC";
	if ($_POST['triDate'] == 'decroissant' && $_POST['triTitre']=='croissant') $sql = " ORDER BY datenews DESC, titrenews ASC";
	if ($_POST['triDate'] == 'croissant' && $_POST['triTitre']=='decroissant') $sql = " ORDER BY datenews ASC, titrenews DESC";

	return $sql;
}

function getTheme(){
	if (!isset($_POST['categorie'])) $sql = "";
	elseif ($_POST['categorie']==null) $sql ="";
	else $sql = " AND theme.description="."\"".$_POST['categorie']."\"";
	return $sql;
}
