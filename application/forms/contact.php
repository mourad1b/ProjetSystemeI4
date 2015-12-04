<?php 
	// Envoyer le message
	if(isset($_POST['message']) && !empty($_POST['message'])) {
		$resultat = mail($_POST['destinataire'], 'Formulaire de contact YLire', $_POST['message']."\n".$_POST['email']);
		if(true == $resultat) {
			echo "Votre message ci-dessous a bien été envoyé :<br/>";
			echo htmlentities($_POST['message'])."<br/>";
		}
	}
?>
<form method="post" action="index.php?p=contact">
	<label for="email">Votre email</label><br/>
	<input type="text" id="email" name="email" />
	<br/>
	<label for="message">Votre message</label><br/>
	<textarea id="message" name="message" cols="40" rows="4"></textarea>
	<br/>
	<input type="hidden" name="destinataire" value="contact@example.org" />
	<input type="submit" name="ok" value="Envoyer votre message" />
</form>
