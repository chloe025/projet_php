<?php
include('../model/bdd_connexion.php');

if (isset($_POST['titre']))
    $titre = htmlspecialchars($_POST['titre']);
if (isset($_POST['texte']))
    $texte = htmlspecialchars($_POST['texte']);

echo $_POST['titre'];
echo $_POST['texte'];
$texte=nl2br($texte);
$req = $bdd->prepare('UPDATE news SET textenews=?, datenews=? WHERE titrenews=?');
$req->execute(array(    
    $texte,
    date('Y-m-d'),
    $titre  
    ));
$req->closeCursor();
header('Location: ../controller/ctrlNews.php');

?>