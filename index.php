<?php

require('model/model.php');

// si on a un titre et un auteur dans la saisie
if (isset($_POST['title']) AND !empty($_POST['title']) AND isset($_POST['auteur']) AND !empty($_POST['auteur']) ){
    $req2 = getArticlesTries();
}
// si on a uniquement un auteur
elseif(isset($_POST['auteur']) AND !empty($_POST['auteur'])) {
    $req2 = getArticlesTriAuteur();
}
// si on a uniquement un titre
elseif (isset($_POST['title']) AND !empty($_POST['title'])) {
    $req2 = getArticlesTriTitle();
}
// si on a juste les radiobuttons
elseif (isset($_POST['triDate']) AND !empty($_POST['triDate']) AND isset($_POST['triTitre']) AND !empty($_POST['triTitre'])){
    $req2 = getArticles();
}

// si on a rien, on affiche par défaut (mais ya pas de possibilité de tri)
else{
    $req2 = getArticlesFirstTime();

}
$req1 = getCategories();


require('view/afficheAccueil.php');
