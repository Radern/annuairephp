<?php
include_once "entetes/header.php";
?>
<script src="include/javas.js" type="text/javascript"></script>
<?php
echo afficheContainerPrincipal(true, "");

if (isset($_GET['fic']) && is_numeric($_GET['fic'])) {
    // objet à rechercher
    $id_utilisateur = $_GET['fic'];
} else {
    $id_utilisateur = 0;
}

$conn = connecte();
if ($id_utilisateur > 0) {
    
    $personne = new Personne($id_utilisateur, null, null);
    // recherche du titre et du type de l'objet
    if ($personne->getId() > 0) {
        $id = $personne->getId();
        $numero = $personne->getTelephone()->getNumero();
        $rue1 = $personne->getAdresse()->getRue1();
        $rue2 = $personne->getAdresse()->getRue2();
        $ville = $personne->getAdresse()->getVille();
        $codepostal = $personne->getAdresse()->getCodePostal();
        
        // Page 1 **************************************************
        $chaine = '<div id="page1" style="DISPLAY: block;">';
        $chaine .= '<div class="page-header"><img src="images/flecheb.gif" alt=""/><b>Fiche</b>&nbsp;&nbsp;-&nbsp;&nbsp;<a onclick="echange_window(document.getElementById(\'page2\'),document.getElementById(\'page1\')); return false;" href="#">Adresse</a></div>';
        $tableau1 = '<table class="table table-striped"><tbody>';
        $tableau1 .= '<tr><td>Nom</td><td>' . $personne->getNom() . '</td></tr>';
        $tableau1 .= '<tr><td>Prénom</td><td>' . $personne->getPrenom() . '</td></tr>';
        $tableau1 .= '<tr><td>Numéro</td><td>' . $personne->getTelephone()->getNumero() . '</td></tr>';
        $tableau1 .= '</tbody></table>';
        
        $texte = affichePanel('Fiche', $tableau1, "panel-info");
        $chaine .= afficheColonne($texte, "col-sm-6");
        $chaine .= '</div>';
        
        // Page 2 **************************************************
        $chaine .= '<div id="page2" style="DISPLAY: none;">';
        $chaine .= '<div class="page-header"><a onclick="echange_window(document.getElementById(\'page1\'),document.getElementById(\'page2\')); return false;" href="#">Fiche</a>&nbsp;<img src="images/flecheb.gif" alt=""/>&nbsp;&nbsp;-&nbsp;&nbsp;<b>Adresse</b></div>';
        $tableau2 = '<table class="table table-striped"><tbody>';
        $tableau2 .= '<tr><td>Rue1</td><td>' . $personne->getAdresse()->getRue1() . '</td></tr>';
        $tableau2 .= '<tr><td>Rue2</td><td>' . $personne->getAdresse()->getRue2() . '</td></tr>';
        $tableau2 .= '<tr><td>Ville</td><td>' . $personne->getAdresse()->getVille() . '</td></tr>';
        $tableau2 .= '<tr><td>Code postal</td><td>' . $personne->getAdresse()->getCodePostal() . '</td></tr>';
        $tableau2 .= '</tbody></table>';
        
        $texte = affichePanel('Adresse', $tableau2, "panel-info");
        $chaine .= afficheColonne($texte, "col-sm-6");
        $chaine .= '</div>';
        // Affichage
        echo $chaine;
    } else {
        afficheErreur("Fiche Introuvable.");
    }
    deconnecte($conn);
} else {
    afficheErreur("Paramètre manquant.");
}

echo afficheContainerPrincipal(false, "");
include "entetes/footer.php";
