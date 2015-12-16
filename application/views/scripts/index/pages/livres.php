<?php 
require_once 'config/configuration.php';

	// Liste des livres commandés par l'utilisateur.
	$requete = "SELECT * FROM tp3_livre INNER JOIN tp3_commande ON (id_livre = livre_id) WHERE utilisateur_id = ".$bd->quote($_SESSION['identifiant_utilisateur']);
	$resultat = $bd->query($requete);
	$livres = $resultat->fetchAll(PDO::FETCH_ASSOC);
	if($livres > 0) {
		echo '<ul>';
		foreach($livres as $livre) {
			echo '<li>';
				echo $livre['titre'].' - ';
				echo $livre['auteurs'].' - ';
				echo $livre['nb_pages'].' - ';
				if(file_exists('livres/'.$livre['fichier'])) {
					echo '<a href="livres/'.$livre['fichier'].'">Télécharger</a>';
				}
				else {
					echo 'Nous contacter car le livre a été supprimé de notre serveur.';
				}
			echo '</li>';
		}
		echo '</ul>';
	}
	else {
		echo "Vous n'avez encore acheté aucun livre";
	}
?>
