<?php 
require_once 'configuration.php';


if(isset($_SESSION['identifiant_utilisateur']) && $_SESSION['identifiant_utilisateur'] > 0) {
    $requete = "SELECT nom FROM user WHERE nom=".$bd->quote($_SESSION['identifiant_utilisateur']);
    $resultat = $bd->query($requete);
    $utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
    if(isset($utilisateur['identifiant']) && strlen($utilisateur['identifiant']) > 0) {
        echo "<div class=\"utilisateur\">".$utilisateur['identifiant']."</div>";
    }
}

?>

<div id="page">
		<?php 
			if(isset($_GET['p'])):
				include_once '../pages/'.$_GET['p'].'.php';
			else:
				include_once '../pages/accueil.php' ;
			endif;
		?>
</div>


