<?php
include('../model/bdd_connexion.php');

if (isset($_POST['mdpC']))
	$mdp = htmlspecialchars($_POST['mdpC']);
if (isset($_POST['mailC']))
	$mail = htmlspecialchars($_POST['mailC']); 

$req = $bdd->prepare('SELECT * FROM redacteur where adressemail = ?');
$req->execute(array($mail));
$result = $req->fetch();
if ($result == null){
	?>
	<script language="javascript" type="text/javascript">
		alert("Adresse mail ou mot de passe incorrect");
		history.back(); //permet de retourner à la création du compte après l'alerte
		</script>
		<?php
	
}
else {
	$mdp_hash = password_verify($mdp, $result['motdepasse']);
	if ($mdp_hash) {
		session_start();
		$_SESSION['autorisee'] = true;
		$_SESSION['id_user'] = $result['idredacteur'];
		$req->closeCursor();
		header('Location: ../index.php');
	}
}
?>