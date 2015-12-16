<?php 
require_once 'config/configuration.php';

	// Traitement du formulaire d'authentification.
	if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {
		$identifiant = $bd->quote($_POST['identifiant']);
		$mot_de_passe = $bd->quote($_POST['mot_de_passe']);
		
		$requete = "SELECT * FROM tp3_utilisateur WHERE identifiant=".$identifiant." AND mot_de_passe=".$mot_de_passe;
		$resultat = $bd->query($requete);
		$utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
		if(isset($utilisateur['id_utilisateur']) && $utilisateur['id_utilisateur'] > 0) {
			$_SESSION['identifiant_utilisateur'] = $utilisateur['id_utilisateur'];
			echo "Merci de cliquer sur ce lien <a href=\"index.php\">accueil</a> pour mettre à jour le menu de navigation.<br/><br/>";
		}
		else {
			echo "Erreur d'authentification.";
		}
	}

// Si le client n'est pas authentifié alors on affiche le formulaire.
if(!isset($_SESSION['identifiant_utilisateur']) || $_SESSION['identifiant_utilisateur'] < 1) {
?>
	<form method="post" action="index.php">
		<label for="identifiant">Identifiant</label>
		<input type="text" id="identifiant" name="identifiant" />
		<br/>
		<label for="mot_de_passe">Mot de passe</label>
		<input type="password" id="mot_de_passe" name="mot_de_passe" />
		<br/>
		<input type="submit" name="ok" value="OK" />
	</form>
<?php 
}
// Sinon si le client est authentifié on lui affiche un message.
else {
?>
	Vous êtes correctement authentifié.	
<?php 
} 
?>
