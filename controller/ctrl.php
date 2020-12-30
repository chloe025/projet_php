<?php

require('../model/userModel.php');

if(isset($_POST['oui'])){
	deconnexion();
}
if(isset($_POST['okSuppr'])){
	supprCompte();
}
elseif((isset($_POST['infos'])) ){
	$reponse = getInformations();
}
else{
	$reponse = getInformations();
}

require('../view/user.php');