<?php

namespace Newsletter\Config;

/**
 * DataBase
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'newsletter');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Link generation
 *
 * Pour du localHost la première méthode renvoie : http://localhost/Dir/Newsletter/Web/index.php
 */

// Spécifie le chemin pour la génération du lien lors de l'envoie du mail
define('PATH_TO_FRONT_CONTROLLER', 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]); // Le front controleur est toujours celui à prendre les paramètres $_GET On les envoie donc à lui pour le mail
//define('PATH_TO_FRONT_CONTROLLER', 'http://localhost/Cours/TP04/Newsletter/Web/index.php'); //Dans les autres cas le définir à la main
