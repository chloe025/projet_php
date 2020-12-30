<?php
function getArt(){
	include('bdd_connexion.php');
	$req = $bdd->prepare('SELECT titrenews from news WHERE idredacteur = ?');
	$req->execute(array($_SESSION['id_user']));
	return $req;
}