<?php
session_start();
require('../model/modifArtModel.php');

$req = getArt();

require('../view/modif_article.php');