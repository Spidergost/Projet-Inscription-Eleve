<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/insertion-stagiaire.css" media="screen" />
        <title>Ajout d'une nationalité</title>
    </head>

    <body>

    	<div class="titre">
    		<h1> Ajout d'une nationalité </h1>
    	</div>
		<form method="post" action="traitement-nationalite.php" class="formulaire">
		
	    	<p>Nationalité : <br /><input type="text" name="nationalite" /> <br /> </p>
			
	      	<p>
				<input type="submit" value="Valider l'ajout" />
	     	</p>
    	</form>
    	
    	<a href="index.php">Retour au menu</a>

    	<?php
    		// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur']==1) {
					echo "<script>alert('Veuillez remplir le formulaire en entier.')</script>";
				}
			}	
		?>
    
    </body>
</html>