<?php 

// Configuration du site.
define('BD_HOST', 'localhost');
define('BD_NOM_BASE', 'newsletter');
define('BD_UTILISATEUR', 'root');
define('BD_MOT_DE_PASSE', '');

// Création ou récupération de la session.
	session_start();
	session_regenerate_id();	

	// Chargement.
	include_once 'chargement.php';
	
	// Connexion à la base de données.
	try {
            $GLOBALS['bd'] = new PDO('mysql:host='.BD_HOST.';dbname='.BD_NOM_BASE, BD_UTILISATEUR, BD_MOT_DE_PASSE
                    //,array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
	}
	catch (PDOException $e) {
		echo "Échec de la connexion à la base de données.";
		//echo $e->getMessage();
    	exit();
	}

	/*
function __autoload($nomClass){
	//string ucfirst ( string $nomClass );
	require_once('classes/'.$nomClass.'.php');
}
*/
