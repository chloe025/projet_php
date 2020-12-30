<?php
function getInformations(){
	include('bdd_connexion.php');
	$reponse = $bdd->prepare('SELECT * FROM redacteur WHERE idredacteur= ?');
	return $reponse;
}

function deconnexion(){
	include('bdd_connexion.php');
	session_start();
	session_destroy();
	header('Location: ../index.php');
}

function supprCompte(){
	include('bdd_connexion.php');
	session_start();
	$req = $bdd->prepare('UPDATE `news`SET `idredacteur`= 16 WHERE idredacteur=?');
	$req->execute(array($_SESSION['id_user']));

	$req->closeCursor();
	$req = $bdd->prepare('DELETE from redacteur WHERE idredacteur= ?');
	$req->execute(array($_SESSION['id_user']));
	$req->closeCursor();
	session_destroy();
	header('Location: ../index.php');
}


