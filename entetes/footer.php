<?php
if ($affiche_certif == 1) {
    $strJour = array(
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi"
    );
    $strMois = array(
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Aoüt",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre"
    );
    $maintenant = time();
    $mois = date("m", $maintenant);
    // echo '&nbsp;'.$strJour[date("w", $maintenant)];
    // echo date (" d ", $maintenant).$strMois [ $mois - 1 ].date(" Y", $maintenant);
    $journee = '&nbsp;' . $strJour[date("w", $maintenant)] . date(" d ", $maintenant) . $strMois[$mois - 1] . date(" Y", $maintenant);
    
    $f = getmicrotime();
    $d = ($f - $microstart);
    
    ?>

<!-- Pied de page -->
<footer class="footer">
    <div class="container">
        <p class="code">
                <?php echo $journee; ?>&nbsp;(2016) v1.0
                <?php echo '<div>Page g&eacute;n&eacute;r&eacute;e en '.substr($d,0,6).' sec (mem:'.memory_get_usage().')<br/>'.$chainebdd.'</div>'; ?>
            </p>
    </div>
</footer>
<?php } ?>
<!-- /Pied de page -->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
        window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')
    </script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
