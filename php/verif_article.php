<?php
include('../model/bdd_connexion.php');
session_start();

if (isset($_POST['categorie']))
    $categorie = htmlspecialchars($_POST['categorie']);
if (isset($_POST['titre']))
    $titre = htmlspecialchars($_POST['titre']);
if (isset($_POST['texte']))
    $texte = htmlspecialchars($_POST['texte']);

// on récupère l'id du thème choisi
$req = $bdd->prepare('SELECT idtheme FROM theme WHERE description= ?');
$req->execute(array($_POST['categorie']));
$result = $req->fetch();
$_POST['categorie'] = $result['idtheme'];
$req->closeCursor();

$bool = true;
$req = $bdd->query('SELECT * from news');
while($result =$req->fetch()){
    if(strtolower($titre) == strtolower($result['titrenews'])){
        $bool = false;
    }
}
$req->closeCursor();
if ($bool == true) {
    $id = $_SESSION['id_user'];
    $texte=nl2br($texte);
    $req = $bdd->prepare('INSERT INTO news(idtheme, titrenews, datenews, textenews, idredacteur) VALUES(:idtheme, :titrenews, :datenews, :textenews, :idredacteur)');
    $req->execute(array(
        'idtheme'=> $_POST['categorie'],
        'titrenews'=> $titre,
        'datenews' => date('Y-m-d'),
        'textenews' => $texte,
        'idredacteur' => $id
    ));
    $req->closeCursor();
    header('Location: ../controller/ctrlNews.php');
}
else{
    ?>
    <script type="text/javascript">
        alert('le titre est déjà existant, veuillez en choisir un autre');
        history.back();
    </script>
    <?php
}

?>