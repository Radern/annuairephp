<?php
$mysqlhost = "172.17.0.2";
$mysqlbdd = "annuaire";
$mysqluser = "annuaire";
$mysqlpass = "annuaire";
$Nb_pers_page = 2;

// connection au serveur sql
function connecte()
{
    global $mysqlhost, $mysqlbdd, $mysqluser, $mysqlpass;
    
    $conn = mysqli_connect($mysqlhost, $mysqluser, $mysqlpass, $mysqlbdd);
    
    /* V�rification de la connexion */
    if (mysqli_connect_errno()) {
        echo "Impossible d&#146;&eacute;tablir la connexion &agrave; ", $mysqlhost, "<br/>";
        exit();
    }
    
    mysqli_select_db($conn, "$mysqlbdd");
    return $conn;
}

// pour une requete renvoyant une table
function requete($Query)
{
    global $conn, $chainebdd;
    $rs = mysqli_query($conn, $Query);
    if (! $rs) {
        $a = "'" . mysqli_real_escape_string($conn, $Query) . "'";
        $b = "'" . str_replace("'", "\'", mysqli_error($conn)) . "'";
        die('Requête0 invalide:' . $a . '<br/>' . $b);
    }
    $chainebdd = $chainebdd . '<br/>&nbsp;' . $Query;
    return $rs;
}

// pour une requete update et autre sans attente de résultat
function requete0($Query)
{
    global $conn, $chainebdd;
    $rs = mysqli_query($conn, $Query);
    if (! $rs) {
        $a = "'" . mysqli_real_escape_string($conn, $Query) . "'";
        $b = "'" . str_replace("'", "\'", mysqli_error($conn)) . "'";
        die('Requête0 invalide:' . $a . '<br/>' . $b);
    }
    $chainebdd = $chainebdd . '<br/>' . $Query;
    if (is_resource($rs)) {
        mysqli_free_result($rs);
    }
    return mysqli_affected_rows($conn);
}

// deconnection mysql
function deconnecte($conn)
{
    mysqli_close($conn);
}

function afficheErreur($message)
{
    echo '<span class="label label-danger">' . $message . '</span>';
}

function afficheOk($message)
{
    echo '<span class="label label-success">' . $message . '</span>';
}

function affichePanel($titre, $texte, $typePanel = "panel-default")
{
    $panel = affichePanelPartiel(true, $titre, $typePanel);
    $panel .= $texte;
    $panel .= affichePanelPartiel(false, $titre, $typePanel);
    return $panel;
}

function affichePanelPartiel($ouverture, $titre, $typePanel = "panel-default")
{
    if ($ouverture == true) {
        $panel = '<div class="panel ' . $typePanel . '">';
        $panel .= '<div class="panel-heading">';
        $panel .= '<h3 class="panel-title">' . $titre . '</h3>';
        $panel .= '</div>';
        $panel .= '<div class="panel-body">';
    } else {
        $panel = '</div>';
        $panel .= '</div>';
    }
    return $panel;
}

function nettoyagedisc()
{ // nettoyer les photos utilisateurs
    $chemin = "img/";
    $folder = dir($chemin);
    $chaine = '';
    while ($fichier = $folder->read()) {
        if ($fichier != 'reduit.jpg' && $fichier != 'normal.jpg' && $fichier != 'rien.jpg' && $fichier != 'mrien.jpg' && $fichier != '.' && $fichier != '..' && $fichier != 'index.html') {
            $supernom = $chemin . $fichier;
            $numero = substr($fichier, 0, 1);
            if ($numero != 'm') {
                $result = requete("SELECT id FROM objet WHERE image$numero='$fichier' LIMIT 1");
                if (! $row = mysqli_fetch_object($result)) {
                    unlink($supernom);
                    $supernom1 = $chemin . "m" . $fichier;
                    unlink($supernom1);
                    $chaine .= 'Effacement de ' . $supernom . '<br/>';
                }
                if (is_resource($result))
                    mysqli_free_result($result);
            }
        }
    }
    if (strlen($chaine) > 1)
        echo '<br/>' . $chaine . '<br/>';
    $folder->close();
}

function afficheColonne($contenu, $typeColonne = "col-sm-4")
{
    $chaine = afficheColonnePartiel(true, $typeColonne);
    $chaine .= $contenu . "\n";
    $chaine .= afficheColonnePartiel(false, $typeColonne);
    return $chaine;
}

function afficheColonnePartiel($ouverture, $typeColonne = "col-sm-4")
{
    if ($ouverture == true) {
        $chaine = '<!-- ' . $typeColonne . ' -->' . "\n";
        $chaine .= '<div class="' . $typeColonne . '">' . "\n";
    } else {
        $chaine = '</div>' . "\n";
        $chaine .= '<!-- /.' . $typeColonne . ' -->' . "\n";
    }
    return $chaine;
}

function afficheContainerPrincipal($ouverture, $titre = "")
{
    if ($ouverture == true) {
        $chaine = '<!-- Contenair Principal -->' . "\n";
        $chaine .= '<div class="container">' . "\n";
        if (! empty($titre)) {
            $chaine .= '<div class="page-header">' . "\n";
            $chaine .= '<h1>Panels</h1>' . "\n";
            $chaine .= '</div>' . "\n";
        }
        $chaine .= '<div class="row">' . "\n";
    } else {
        $chaine = '</div>' . "\n";
        $chaine .= '</div>' . "\n";
        $chaine .= '<!-- /Contenair Principal -->' . "\n";
    }
    return $chaine;
}

function getmicrotime()
{
    list ($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}
