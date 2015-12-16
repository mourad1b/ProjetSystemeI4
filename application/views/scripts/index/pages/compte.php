<?php 
require_once 'configuration.php';

	// Affichage des informations de l'utilisateur connecté.
	$requete = "SELECT * FROM tp3_utilisateur WHERE id_utilisateur=".$bd->quote($_SESSION['identifiant_utilisateur']);
	$resultat =$bd->query($requete);
	$utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
	if(count($utilisateur)>0) {
		echo 'Votre identifiant : '.$utilisateur['identifiant'].'<br/>';
		if($utilisateur['credit'] > 0) {
			echo 'Vous pouvez encore acheter '.$utilisateur['credit'].' livre(s).<br/>';
		}
		else {
			echo "Vous n'avez plus de crédits pour acheter des livres.<br/>";
		}
		echo 'Date de création de votre compte : '.strftime('%d/%m/%Y', strtotime($utilisateur['date_creation'])).'<br/>';
	}
	else {
		echo "Compte introuvable.";		
	}
?>
