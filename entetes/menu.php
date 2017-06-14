<!-- Fixed navbar MENU -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Annuaire</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#" class="dropdown-toggle"
                    data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">Compte<span
                        class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="formulaires.php?action=Ajouter">&nbsp;Ajouter
                                un enregistrement</a></li>
                        <li><a href="consultation.php">&nbsp;Liste des
                                enregistrements</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a>&nbsp;Rechercher</a></li>

                    </ul></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle"
                    data-toggle="dropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">? <span
                        class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="aide.php">Information</a></li>
                    </ul></li>
            </ul>
            <!--/.nav-collapse -->
        </div>
    </div>
</nav>
<!-- /Fixed navbar MENU -->

<?php
if (isset($_SESSION['serreur'])) {
    echo $_SESSION['serreur'];
    unset($_SESSION['serreur']);
}
