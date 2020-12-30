<?php
include('../model/bdd_connexion.php');
session_start();
						if (isset($_POST['nom']))
						    $nom = htmlspecialchars(strtoupper($_POST['nom']));
						if (isset($_POST['prenom']))
						    $prenom = htmlspecialchars(strtolower($_POST['prenom']));
						if (isset($_POST['mail']))
						    $mail = htmlspecialchars($_POST['mail']);
						if (isset($_POST['mdp']))
						    $mdp = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);

						$req = $bdd->prepare('SELECT adressemail from redacteur where adressemail = ?');
						$req->execute(array($mail));
						$response = $req->fetch();
						if ($response['adressemail'] == $mail) {    
						    ?>
								<script language="javascript" type="text/javascript">
								alert("Adresse mail déjà existante!");
								history.back(); //permet de retourner à la modification du compte après l'alerte
								</script>
								<?php
						}
						else{
						    $req->closeCursor();

						    $req = $bdd->prepare('UPDATE redacteur SET nom=?, prenom=?, adressemail=?, motdepasse=? WHERE idredacteur=?');
						    $req->execute(array(
						    	
						    	$nom,
						    	$prenom,
						    	$mail,
						    	$mdp,
						    	$_SESSION['id_user']
						        
						        
						    ));
						$req->closeCursor();
						header('Location: user.php');
					}
				?>