<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/insertion-stagiaire.css" media="screen" />
        <title>Ajout d'un formateur et d'une formation </title>
    </head>

    <body>

    	<div class="titre">
    		<h1> Ajout d'un formateur et d'une formation </h1>
    	</div>
		<form method="post" action="traitement-formation-formateur.php" class="formulaire">
		
	    	<p>Nom du Formateur : 	<input type="text" name="nom" /> </p>
			<p>Prénom du Formateur : 	<input type="text" name="prenom" /> </p>
			<p>Salle du Formateur : 	<input type="text" name="salle" /> </p>
			<p>Date de début de la formation (AAAA-MM-JJ):	 <input type="text" name="debut" /> </p>
			<p>Date de fin de la formation (AAAA-MM-JJ) : 	<input type="text" name="fin" />  </p>
			<p>Formation :	 <input type="text" name="formation" /> </p>
			
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

