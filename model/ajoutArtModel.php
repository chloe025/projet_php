<?php

function getTheme(){
	include('bdd_connexion.php');
	$req = $bdd->query('SELECT * from theme');
	return $req;
}