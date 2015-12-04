<?php 
	// Enregistrement de la commande.
	if(isset($_GET['id_livre']) && $_GET['id_livre']>0) {
		try {
			$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bd->beginTransaction();
			$bd->exec("INSERT INTO tp3_commande (utilisateur_id, livre_id,  date_achat) VALUES (".$bd->quote($_SESSION['identifiant_utilisateur']).", ".$bd->quote($_GET['id_livre']).", NOW())");
			$bd->exec("UPDATE tp3_utilisateur SET credit=credit-1 WHERE id_utilisateur=".$bd->quote($_SESSION['identifiant_utilisateur']));
			$bd->commit();
			echo "Commande effectuée. Vous pouvez télécharger le livre depuis la page Mes livres.";
				
		} catch(Exception $e) {
			$bd->rollBack();
			echo "Erreur lors de votre commande : ".$e->getMessage();
		}
	}
	// Vérification que l'utilisateur connecté peut acheter des livres.
	$requete = "SELECT * FROM tp3_utilisateur WHERE id_utilisateur=".$bd->quote($_SESSION['identifiant_utilisateur']);
	$resultat = $bd->query($requete);
	$utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
	if(count($utilisateur)<1 || !isset($utilisateur['credit']) || $utilisateur['credit']<1) {
		echo "Vous n'avez plus de crédits pour acheter des livres.<br/>";
	}
	else {
		// Liste des livres que l'utilisateur peut acheter.
		$requete = "SELECT id_livre, titre FROM tp3_livre WHERE id_livre NOT IN (SELECT livre_id FROM tp3_commande WHERE utilisateur_id=".$bd->quote($_SESSION['identifiant_utilisateur']).")";
		$resultat = $bd->query($requete);
		$livres = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>
<form method="get" action="index.php">
	<select name="id_livre">
		<option value="0">Choisissez votre livre.</option>
		<?php 
			foreach($livres as $livre) {
				echo '<option value="'.$livre['id_livre'].'">'.$livre['titre'].'</option>';
			}
		?>
	</select>
	<br/>
	<input type="hidden" name="p" value="commander" />
	<input type="submit" name="ok" value="Commander" />
</form>
<?php 
}
?>
