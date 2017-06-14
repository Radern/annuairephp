<?php
include "entetes/header.php";

$conn = connecte();
$fiche = 0;
echo afficheContainerPrincipal(true, "");
if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = '';

if (isset($_POST['prenom'], $_POST['nom'], $_POST['numero'], $_POST['rue1'], $_POST['rue2'], $_POST['codepostal'], $_POST['ville'])) {
    $nom = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
    $prenom = trim(filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING));
    $numero = trim(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING));
    $typenumero = trim(filter_input(INPUT_POST, 'typenumero', FILTER_SANITIZE_STRING));
    $rue1 = trim(filter_input(INPUT_POST, 'rue1', FILTER_SANITIZE_STRING));
    $rue2 = trim(filter_input(INPUT_POST, 'rue2', FILTER_SANITIZE_STRING));
    $codepostal = trim(filter_input(INPUT_POST, 'codepostal', FILTER_VALIDATE_INT));
    $ville = trim(filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING));
    $action = strtoupper($action);
} elseif ($action == "Modifier") {
    $titre = 'Modification fiche';
    if (isset($_GET['fiche']) && is_numeric($_GET['fiche'])) {
        $fiche = $_GET['fiche'];
        $personne = new Personne($fiche, null, null);
        $nom = $personne->getNom();
        $prenom = $personne->getPrenom();
        $id = $personne->getId();
        $numero = $personne->getTelephone()->getNumero();
        $rue1 = $personne->getAdresse()->getRue1();
        $rue2 = $personne->getAdresse()->getRue2();
        $ville = $personne->getAdresse()->getVille();
        $codepostal = $personne->getAdresse()->getCodePostal();
    }
} else {
    $titre = 'Nouvelle fiche';
    $nom = "";
    $prenom = "";
    // $id = $personne->getId();
    $numero = "";
    $rue1 = "";
    $rue2 = "";
    $ville = "";
    $codepostal = "";
}

if ($action == "AJOUTER" && strlen($nom) > 0) {
    $personne = new Personne(0, $nom, $prenom);
    $personne->getTelephone()->setTelephonePersonne($numero, $typenumero);
    $personne->getAdresse()->setAdressePersonne($rue1, $rue2, $codepostal, $ville);
    $personne->createPersonne();
    afficheOk("Création Ok");
    $action = '';
}
if ($action == "MODIFIER") {
    $titre = 'Modification fiche';
    if (isset($_POST['fiche']) && is_numeric($_POST['fiche'])) {
        $fiche = $_POST['fiche'];
    }
    if ($fiche > 0) {
        $personne = new Personne($fiche, null, null);
        if ($personne->getId() > 0) {
            $action = '';
            $personne->setNom($nom);
            $personne->setPrenom($prenom);
            $personne->getTelephone()->setTelephonePersonne($numero, $typenumero);
            $personne->getAdresse()->setAdressePersonne($rue1, $rue2, $codepostal, $ville);
            $personne->modifyPersonne();
            afficheOk("Modification Ok");
            $action = '';
        }
    }
}

if (strlen($action) > 0) { // Affichage du formulaire
    echo afficheColonnePartiel(true);
    echo affichePanelPartiel(true, "$titre", "panel-default");
    ?>

<form class="form-signin"
    action="formulaires.php?action=<?php echo $action; ?>" method="post">
    <fieldset class="form-group">
        <label for="nom0">Nom</label> <input id="nom0"
            class="form-control" required autofocus placeholder="nom"
            type="text" value="<?= $nom ?>" size="18" name="nom"
            maxlength="50" /> <label for="prenom0">Prénom</label> <input
            id="prenom0" class="form-control" required autofocus
            placeholder="prénom" type="text" value="<?= $prenom ?>"
            size="18" name="prenom" maxlength="50" />
    </fieldset>
    <fieldset class="form-group">
        <label for="numero0">Numéro</label> <input id="numero0"
            class="form-control" required autofocus placeholder="numéro"
            type="tel" value="<?= $numero ?>" size="18" name="numero"
            pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" />
        <label for="typenumero">Type</label> <input id="typage"
            class="form-control" type="hidden" value="<?= $fiche ?>"
            name="fiche" /> <select id="typenumero" name="typenumero">
            <option value="portable">portable</option>
            <option value="fixe">fixe</option>
        </select>
    </fieldset>
    <fieldset class="form-group">
        <label for="rue1">Rue 1</label> <input id="rue1"
            class="form-control" required autofocus placeholder="rue 1"
            type="text" value="<?= $rue1 ?>" size="18" name="rue1"
            maxlength="50" /> <label for="rue2">Rue 2</label> <input
            id="rue2" class="form-control" required autofocus
            placeholder="rue 2" type="text" value="<?= $rue2 ?>"
            size="18" name="rue2" maxlength="50" /> <label
            for="codepostal">Code postal</label> <input id="codepostal"
            class="form-control" required autofocus
            placeholder="code postal" type="number"
            value="<?= $codepostal ?>" size="10" name="codepostal"
            min="1" max="99999" /> <label for="ville">Ville</label> <input
            id="ville" class="form-control" required autofocus
            placeholder="ville" type="text" value="<?= $ville ?>"
            size="18" name="ville" maxlength="50" />
    </fieldset>
    <button class="btn btn-sm btn-primary" name="submit" type="submit"
        value="Enregistrer">Enregistrer</button>
</form>

<?php
    echo affichePanelPartiel(false, null, null);
    echo afficheColonnePartiel(false);
    $chaine1 = affichePanel("Information", "Merci de remplir cette nouvelle fiche", "panel-info");
    echo afficheColonne($chaine1);
}

deconnecte($conn);
echo afficheContainerPrincipal(false, "");
include "entetes/footer.php";
