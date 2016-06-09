<?php

namespace nsNewsletter\Config;

/**
 * DataBase
 */
/*
define('DB_HOST', 'mysql.montpellier.epsi.fr:5206');	// mysql.montpellier.epsi.fr:5206
														// Port interne= 3306 externe=5206
define('DB_NAME', 'newsletters');
define('DB_USER', 'appnewsletter');						// prenom.nom
define('DB_PASS', 'Epsi2015');							// epsiMotDePasseEpsi
*/

define('DB_HOST', 'localhost');	
define('DB_NAME', 'newsletters');
define('DB_USER', 'root');
define('DB_PASS', '');


/**
 * Link generation
 *
 * Pour du localHost la première méthode renvoie : http://localhost/Dir/Newsletter/Web/index.php
 */

// Spécifie le chemin pour la génération du lien lors de l'envoie du mail
define('PATH_TO_FRONT_CONTROLLER', 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]); // Le front controleur est toujours celui à prendre les paramètres $_GET On les envoie donc à lui pour le mail
//define('PATH_TO_FRONT_CONTROLLER', 'http://localhost/Cours/Newsletter/Web/index.php'); //Dans les autres cas le définir à la main
