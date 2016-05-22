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

    <!-- ==========================Pour la vue des templates ================================-->
    <!-- Themify Icons
    <link rel="stylesheet" href="../Web/cssTemplates/css/themify-icons.css">

    <!-- Bootstrap
    <link rel="stylesheet" href="../Web/css/cssTemplates/bootstrap.css">
    -->
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/owl.carousel.min.css">
    <link rel="stylesheet" href="../Web/css/cssTemplates/owl.theme.default.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/magnific-popup.css">
    <!-- Superfish -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/superfish.css">
    <!-- Easy Responsive Tabs -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/easy-responsive-tabs.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/animate.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="../Web/css/cssTemplates/style.css">

    <!-- ==========================fin Pour la vue des templates ================================-->

</head>

<body bgcolor="#d4c4b4">




<!--
<div class="fh5co-cards">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 animate-box">
                <div class="commit commit-tease js-details-container"></div>
                <a class="fh5co-card" href="#">
                    <img src="" alt="<?php //echo $newsletter->getNom()?>" class="img-responsive">

                    <div class="fh5co-card-body">
                        <?php //echo $newsletter->getTexte(); ?>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
-->

<div class="row text-center">
    <div class="commit commit-tease js-details-container">
            <div class="afficheCampagne"></div>
        <?php /** @var \nsNewsletter\Model\Newsletter $newsletter */
                echo $newsletter->getTexte();
        ?>
    </div>
</div>

</body>
</html>