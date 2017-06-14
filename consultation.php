<?php
include_once "entetes/header.php";

?>
<script src="include/javas.js" type="text/javascript"></script>
<?php

echo afficheContainerPrincipal(true, "");

$conn = connecte();
// recupere les infos sessions
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$Debut = (($page * $Nb_pers_page) - ($Nb_pers_page));

// Gestion effacement de fiche
if (isset($_GET['adm']) && is_numeric($_GET['adm']) && isset($_GET['fiche']) && is_numeric($_GET['fiche'])) {
    $action = $_GET['adm'];
    
    $personne_id = $_GET['fiche'];
    if ($personne_id != 0 && $action == "1") {
        $personne = new Personne($personne_id, null, null);
        $personne->deletePersonne();
        afficheOk("Personne supprimée");
    }
}

// recherche les objets
$personne = new Personne(0, NULL, NULL);
$Personnes = $personne->getListeALLPersonnes($Debut, $Nb_pers_page);
$nombre = count($Personnes);
$nombreMax = $personne->comptage();

if ($nombre > 0) {
    $chaine = '&nbsp;<table class="table table-striped"><thead><tr>';
    $chaine .= '<th><a href="#" onclick="sortTable(this,1); return false;">&nbsp;Nom&nbsp;</a></th>';
    $chaine .= '<th><a href="#" onclick="sortTable(this,2); return false;">&nbsp;Prénom&nbsp;</a></th>';
    $chaine .= '<th>téléphone</th><th><a href="#" onclick="sortTable(this,3); return false;">&nbsp;Ville&nbsp;</a></th><th>&nbsp;Modifier&nbsp;</th><th>&nbsp;Visualiser&nbsp;</th><th>&nbsp;Effacer&nbsp;</th></tr></thead><tbody>';
    
    foreach ($Personnes as $unePersonne) {
        $chaine .= '<tr><td>&nbsp;' . $unePersonne->getNom() . '&nbsp;</td>';
        $chaine .= '<td>&nbsp;' . $unePersonne->getPrenom() . '&nbsp;</td>';
        $chaine .= '<td>&nbsp;' . $unePersonne->getTelephone()->getNumero() . '&nbsp;</td>';
        $chaine .= '<td>&nbsp;' . $unePersonne->getAdresse()->getVille() . '&nbsp;</td>';
        $leId = $unePersonne->getId();
        $chaine .= '<td>&nbsp;<a href="formulaires.php?action=Modifier&amp;adm=1&amp;fiche=' . $leId . '&amp;page=' . $page . '">&nbsp;<img src="images/icones/modif3.gif" alt="Modifier"/></a>&nbsp;</td>';
        $chaine .= '<td><a href="visualiser.php?fic=' . $leId . '">&nbsp;<img src="images/icones/vue.gif" alt="Visualiser"/></a>&nbsp;</td>';
        $chaine .= '<td><a href="consultation.php?adm=1&amp;fiche=' . $leId . '" onclick="return confirm(\'Supprimer cette fiche ?\');">&nbsp;<img src="images/icones/efface.gif" alt="BBBB"/></a>&nbsp;</td></tr>';
    }
    $chaine .= '</tbody></table>&nbsp;';
    $chaine1 = ' ';
    
    if ($nombreMax > $Nb_pers_page) {
        $Nb_page = ceil($nombreMax / $Nb_pers_page);
        if ($page != 1) {
            $chaine1 .= '<a href="consultation.php"><img src="images/1440.gif" border="0" alt="<" /></a>&nbsp;<a href="consultation.php?page=' . ($page - 1) . '"><img src="images/144.gif" border="0" alt="<<" /></a>&nbsp;';
        }
        if ($Nb_page > $page) {
            $chaine1 .= '<a href="consultation.php?page=' . ($page + 1) . '"><img src="images/139.gif" border="0" alt=">" /></a>&nbsp;<a href="consultation.php?page=' . $Nb_page . '"><img src="images/1390.gif" border="0" alt=">>" /></a>';
        }
    }
    $chaine .= $chaine1;
    $texte = affichePanel("Liste des inscrits", $chaine, "panel-info");
    $chaine = afficheColonne($texte, "col-sm-8");
    echo $chaine;
} else {
    afficheErreur("Aucune fiche.");
}

deconnecte($conn);

echo afficheContainerPrincipal(false, "");
include "entetes/footer.php";
