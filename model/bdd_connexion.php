<?php
try{	// remplir les données pour se connecter
	$bdd = new PDO('mysql:host=url;port=3306;dbname=namedb' , 'login', 'password', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );  // la dernière partie permet d'afficher les accents sur l'écran
}
catch (Exception $e){
	die('Erreur : '. $e->getMessage());
}
?>