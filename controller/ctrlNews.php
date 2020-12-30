<?php
session_start();
require('../model/newsModel.php');

$req = getArticles();
$req2=getArticleSelected();

if(isset($_POST['validersupp'])){
	supprArticle();
}

require('../view/mesnews.php');