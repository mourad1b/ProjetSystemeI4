<p>Le fichier README modf se trouve <a href="http://localhost/ProjetSystemeI4newsletter/ProjetSystemeI4newsletter/readme.html" target="_blank">ici</a>.</p>

    
<nav>
    <ul>
        <li><a href="http://localhost/ProjetSystemeI4_newsletter/ProjetSystemeI4_newsletter/application/views/scripts/index/index.php">Accueil</a></li>
        <li><a href="config/index.php?p=contact">Contact </a></li>
        <?php 
            if(isset($_SESSION['identifiant_utilisateur']) && $_SESSION['identifiant_utilisateur'] > 0) {
        ?>
        <li><a href="index.php?p=compte">Mon compte</a></li>
        <li><a href="index.php?p=livres">books</a></li>
        <li><a href="index.php?p=commander">Commander</a></li>
        <li><a href="index.php?p=fermer_session">Fermer session</a></li>
	<?php 
            }
	?>
            
    </ul>
        
</nav>

<div id="page">
		<?php 
			if(isset($_GET['p'])):
				include_once 'pages/'.$_GET['p'].'.php';
			else:
				include_once 'pages/accueil.php' ;
			endif;
		?>
</div>
<div>
    <form action="#"
          enctype="multipart/form-data" method="post">
        <br>
        <p>Charger un fichier CSV :<br>
            <input type="file" name="datafile" size="40">
        </p>
        <div>
            <input type="submit" value="Send">
        </div>
    </form>			
        
</div>

