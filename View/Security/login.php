
<!-- SI erreur : on l'affiche
<h1 style="color:darkred">Bad credentials : Identifiants Incorrects</h1>

Sinon formulaire d'Authentification  -->

<?php
/*** begin our session ***/
if(session_id() ===""){
    //var_dump('login not start session: ');
    session_start();
}/*else{
    var_dump('login already started session : ');
}*/

/*** set a form token ***/
$formLogin_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['formLogin_token'] = $formLogin_token;

?>

</br></br>
<div class="login">
    <h1>Authentification requise</h1>
    <form action="../Web/index.php" method="post">
        <input type="hidden" name="formLogin_token" value="<?php echo $formLogin_token; ?>">

        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="_username" value="" required="required">

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="_password" required="required">

        <input type="checkbox" id="remember_me" name="_remember_me" value="on">
        <label for="remember_me">Se souvenir de moi</label>
        <br>
        <input type="submit" id="_submit" name="_submit" value="Connexion">
    </form>
</div>