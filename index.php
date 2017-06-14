<?php
include_once "entetes/header.php";

echo afficheContainerPrincipal(true, "");

$titre = 'Bienvenue';
$texte = 'Annuaire Web<br/>';
$texte .= '<ul>';
$texte .= '<li>HTML 5</li>';
$texte .= '<li>PHP 5.6 (utilisation en mode objet)</li>';
$texte .= '<li>MySQL 5.5.50</li>';
$texte .= '<li>Bootstrap</li>';
echo afficheColonne(affichePanel($titre, $texte), "col-sm-6");
echo afficheContainerPrincipal(false, "");
include "entetes/footer.php";
