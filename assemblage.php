<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/insertion-stagiaire.css" media="screen" />
        <title>Insertion de stagiaire</title>
    </head>

    <body>
	    	<?php
				// Connection a la base
				try {
					// Connexion à la base de données
					$db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
					// prise en charge de l'utf-8
					$db->exec("SET CHARACTER SET utf8");
					echo "Connexion à la base réussi. <br/>";
				}
				catch (PDOException $e) {
					echo "Erreur : " . $e->getMessage() . "<br/>";
					die();
				}
			?>

    	<div class="titre">
    		<h1> Listing en fonction des formations  </h1>
    	</div>

    	<form method="post" action="traitement-listing.php" class="formulaire">
	
	    	<p>Nom :	<br /><input type="text" name="nom" /> <br /> </p>
		  	<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
	      	<p>
			
				Nationalité : 
				<select name="nationalite">
						<option selected="selected" value="1"> Français</option>
						<option value="2"> Anglais</option>
						<option value="3"> Allemand</option>
						<option value="4"> Russe</option>
			    </select>  
	      	</p>
	      
	      	<p>
				Type de la formation : 
				<select name="formation">
						<option selected="selected" value="1"> Web designer</option>
						<option value="2"> Développpeur</option>
			    </select>  
	      	</p>
			<input type="hidden" name="envoi" value="yes">			
			<p>
				 formateurs par date :<br /><br />
				<input type="checkbox" name="option[]" value="1"/> Robert Dupond dans la salle 101,<br />
				<input type="checkbox" name="option[]" value="2"/> Jean Martin dans la salle 102, <br />
				<input type="checkbox" name="option[]" value="3"/> Paul Durand dans la salle 201, <br />
				<input type="checkbox" name="option[]" value="4"/> Alain Duval dans la salle 202, 
			</p>
			
			<p>
				<input type="submit" value="envoyer" />
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
			if (isset($_GET['ajoute'])) {
				if ($_GET['ajoute']==1) {
					echo "<script>alert('Stagiaire ajouté avec succés!')</script>";
				}
			}			
		?>
    
    </body>
</html>