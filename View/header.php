<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion des Newsletters</title>

    <!-- Included CSS Files -->
    <link rel="stylesheet" href="../Web/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Web/styles/css/starter-template.css">
    <link rel="stylesheet" href="../Web/css/foundation.min.css">
    <link rel="stylesheet" href="../Web/styles/css/reset.css">
    <link rel="stylesheet" href="../Web/styles/css/style.css">
    <link rel="stylesheet" href="../Web/styles/css/main.css">
    <link rel="stylesheet" href="../Web/styles/css/list.css">
    <link rel="stylesheet" href="../Web/select/multiple-select.css" />

     <!--for auth-->
    <!--<link rel="stylesheet" href="../Web/styles/css/auth/app_reset_1.css">
    <link rel="stylesheet" href="../Web/styles/css/auth/app_style_3.css">
    <link rel="stylesheet" href="../Web/styles/css/auth/app.css">
    <link rel="stylesheet" href="../Web/styles/css/auth/app_bootstrap.min_2.css">
-->

</head>

<body>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- Included JS Files (Compressed) -->
<script src="../Web/js/jquery-1.12.3.js"></script>
<!--<script src="../Web/js/jquery.js"></script>-->
<script src="../Web/js/list.min.js"></script>
<script src="../Web/js/script.js"></script>
<script src="../Web/js/bootstrap.min.js"></script>
<script src="../Web/js/bootbox.min.js"></script>
<script src="../Web/select/multiple-select.js"></script>

<!-- Includ Scripts JS -->
<script src="../Web/scripts/IHM.js"></script>
<!--
<script src="../Web/scripts/Ajax.js"></script>
-->
<!--
<script src="../Web/scripts/Groupe2.js"></script>
<script src="../Web/scripts/User2.js"></script>
<script src="../Web/scripts/Mail2.js"></script>
<script src="../Web/scripts/User.js"></script>
<script src="../Web/scripts/Mail.js"></script>
<script src="../Web/scripts/Example.js"></script>
-->

<div id="header">
    <div id="header_left">
        <div id="header_left1">
            <h1><a href="">News</a></h1>

            <h3>Gestion des Newsletters</h3>
        </div>
        <div id="header_left2">
            <h2><!--EPSI--></h2>
        </div>
    </div>
    <div id="header_right">
        <p>Bienvenue, <b id="userWelcome" data-idUser="">Nom Prenom</b></p>

        <p><a href="index.php?page=options">Options</a> | <a
                href="index.php?page=Login">Déconnexion</a></p>
    </div>
</div> <!--- header -->

<div id="menu">
    <div id="menu_content">
    </div>
</div>

<div id="bg_sousmenu">
    <ul id="nav">
        <li><a href="index.php" class="radius">Groupes</a></li>
        <li><a href="index.php?page=newsletters" class="radius">Newsletters</a></li>
        <li><a href="index.php?page=mails" class="radius">Mails</a></li>

        <li>
            <a class="depliant" href="#">Administration &#9660;</a>
            <ul class="sous-menu">
                <li><a href="index.php?page=users" class="radius">Gestion utilisateurs</a></li>
                <li><a href="index.php?page=campagnes" class="radius">Campagnes newsletters</a></li>
            </ul>
        </li>
    </ul>
</div>
<br>

<div class="loader text-center" id="loader" style="display: none">
    <img src="../Web/styles/img/loading-img.gif" alt="loading">
    <br><span>Chargement des données...</span>
</div>
<div id="flashMessage" class="alert hidden"></div>
