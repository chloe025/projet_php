<?php

function getArticles(){
	include('bdd_connexion.php');
	$req = $bdd->query('SELECT titrenews from news WHERE idredacteur='.$_SESSION['id_user'].'');
	return $req;
}
function getArticleSelected(){
	include('bdd_connexion.php');
	$req = $bdd->prepare('SELECT * from news, theme, redacteur WHERE redacteur.idredacteur=news.idredacteur AND theme.idtheme=news.idtheme AND news.idredacteur= ? ORDER BY description, datenews DESC LIMIT 0,10');
	$req->execute(array($_SESSION['id_user']));
	return $req;
}

function supprArticle(){
	include('bdd_connexion.php');
	$req = $bdd->prepare('DELETE from news WHERE titrenews= ?');
	$req->execute(array($_POST['titre']));
	$req->closeCursor();
	header('Location: ../controller/ctrlNews.php');
}