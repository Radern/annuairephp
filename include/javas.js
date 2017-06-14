/* Fonctions en Javascript                                                                    */
/*  V1.0 22/07/2016 Par Radern                                                                */
/* echange_window(document1,document2) : Inverser 2 affichage écrans                          */
/* inverse_window(document1) : afficher/cacher une fenêtre                                    */
/* sortTable (tb, n) : pour trier sur une colonne toute une table                             */
/* tri(tb, n) : utilisé par sortable                                                          */
/**********************************************************************************************/

/**
 * Méthode qui sera appelée par inverser 2 affichage écrans
 */
function echange_window(document1, document2) {
    if (document1.style.display != 'block') {
        document1.style.display = 'block';
        if (document2 != null)
            document2.style.display = 'none';
    } else
        document1.style.display = 'none';
}

/**
 * Méthode qui sera appelée par afficher/cacher une fenêtre
 */
function inverse_window(document1) {
    if (document1.style.display != 'block') {
        document1.style.display = 'block';
    } else
        document1.style.display = 'none';
}

var sens = 0;
var old_n = -1;
function sortTable(tb, n) {
    tri(tb, n);
    if (old_n == n) {
        if (sens == 0) {
            sens = 1;
        } else {
            sens = 0;
        }
    } else {
        sens = 1;
        old_n = n;
    }
}

function tri(tb, n) {
    var iter = 0;
    while (!tb.tagName || tb.tagName.toLowerCase() != "table") {
        if (!tb.parentNode)
            return;
        tb = tb.parentNode;
    }
    if (tb.tBodies && tb.tBodies[0])
        tb = tb.tBodies[0];

    /* Tri par sélection */
    var reg = /^\d+(\.\d+)?$/g;
    var index = 0, value = null, minvalue = null;
    for (var i = tb.rows.length - 1; i >= 0; i -= 1) {
        minvalue = value = null;
        index = -1;
        for (var j = i; j >= 0; j -= 1) {
            value = tb.rows[j].cells[n].firstChild.nodeValue;
            if (!isNaN(value))
                value = parseFloat(value);
            if (sens == 0) {
                if (minvalue == null || value < minvalue) {
                    index = j;
                    minvalue = value;
                }
            } else if (minvalue == null || value > minvalue) {
                index = j;
                minvalue = value;
            }
        }
        if (index != -1) {
            var row = tb.rows[index];
            if (row) {
                tb.removeChild(row);
                tb.appendChild(row);
            }
        }

    }
}