
<!-- SI erreur : on l'affiche
<h1 style="color:darkred">Bad credentials : Identifiants Incorrects</h1>

Sinon formulaire d'Authentification  -->

<?php
// Begin the session
if(!session_start()){
    session_start();
}
// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
?>
<!--
</br></br>
<div class="glyphicon-log-out">
    <h1>Déconnecté</h1>
</div>
-->