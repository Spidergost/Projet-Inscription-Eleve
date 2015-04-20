<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/insertion-stagiaire.css" media="screen" />
        <title>Ajout d'un formateur et d'une formation </title>
    </head>

    <body>

    	<div class="titre">
    		<h1> Ajout d'un formateur et d'un formateur </h1>
    	</div>
		<form method="post" action="traitement-formation-formateur.php" class="formulaire">
		
	    	<p>Nom du Formateur : <br /><input type="text" name="nom" /> <br /> </p>
			<p>Prénom du Formateur : <br /><input type="text" name="prenom" /> <br /> </p>
			<p>Salle du Formateur : <br /><input type="text" name="salle" /> <br /> </p>
			<p>Date de début de la formation : <br /><input type="text" name="debut" /> <br /> </p>
			<p>Date de fin de la formation : <br /><input type="text" name="fin" /> <br /> </p>
			<p>Formation : <br /><input type="text" name="formation" /> <br /> </p>
			
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

