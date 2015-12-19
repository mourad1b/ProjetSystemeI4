<?php 
	// Envoyer le message
	if(isset($_POST['message']) && !empty($_POST['message'])) {
		//$resultat = mail($_POST['destinataire'], 'Formulaire de contact', $_POST['message']."\n".$_POST['email']);
            $to      = $_POST['destinataire'];
            $subject = 'Formulaire de contact';
            $message = $_POST['message']."\n".$_POST['email'];
            $headers = 'From: '. $_POST['email'] . "\r\n" .
            'Reply-To: ' . $_POST['email'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            var_dump($_POST);
             if(!filter_var($to, FILTER_VALIDATE_EMAIL)){
                echo "{$_POST['destinataire']} n'est pas une adresse email valide.";
             }
            $resultat = mail($to, $subject, $message, $headers);
                var_dump($resultat);
		if(true == $resultat) {
			echo "Votre message ci-dessous a bien été envoyé :<br/>";
			echo htmlentities($_POST['message'])."<br/>";
		}
                else{
                    echo 'Erreur d\'envoi.';

                }
        }
?>

<!DOCTYPE HTML>

<html>
<head>
<title>Appli Web</title>
<meta charset="UTF-8">
</head>
<body>

<h1>Formulaire de contact</h1>
<form method="post" action="../config/index.php?p=contact">
	<label for="email">Votre email</label><br/>
	<input type="text" id="email" name="email" />
	<br/>
	<label for="message">Votre message</label><br/>
	<textarea id="message" name="message" cols="40" rows="4"></textarea>
	<br/>
	<input type="hidden" name="destinataire" value="mourad_bzd@yopmail.com" />
	<input type="submit" name="ok" value="Envoyer votre message" />
</form>

</body>
<html>
