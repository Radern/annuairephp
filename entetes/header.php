<?php
// include_once "include/securite.php";
include_once "include/fonction.inc.php";
include_once "classes/personne.php";

ini_set('arg_separator.output', '&amp;');
session_start();

$microstart = getmicrotime();
$chainebdd = '';
$affiche_certif = 1;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="language" content="french" />
<meta name="category" content="internet" />
<meta name="Identifier-URL" content="****" />
<meta name="author" content="Radern" />
<meta name="description"
    content="annuaire, adresse, nom, prenom, telephone, mobile" />
<meta name="keywords" content="" />
<meta name="Date-Creation-yyyymmdd" content="2016/07/20" />
<meta name="copyright" content="Copyright 2016 Radern" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Annuaire</title>
<link rel="shortcut icon" type="image/x-icon"
    href="http://www.radern.com/images/favicon.ico" />

<!-- Bootstrap core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css"
    rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/navbar-fixed-top.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php include_once "entetes/menu.php"; ?>
<body>