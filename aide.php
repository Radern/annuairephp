<?php
include "entetes/header.php";

echo afficheContainerPrincipal(true, "");
$chaine1 = affichePanel("A Propos", 'V1.00 <br/>&nbsp;<br/>(2016)', "panel-danger");
echo afficheColonne($chaine1);
echo afficheContainerPrincipal(false, "");
include "entetes/footer.php";
