﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/affichage-formateur.css" media="screen" />
        <title>Affichage formateur</title>
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
    		<h1> Listing en fonction des formations </h1>
    	</div>
    	<form method="post" action="traitement-affichage-formateur.php" class="formulaire">
    		<?php
		        // FORMATION
		    	// Requête pour avoir le nombre de formation
		    	$requeteNbFormation = $db->query('SELECT COUNT(ID_TYPE_FORMATION) FROM TYPE_FORMATION');
		        $valeurNbFormation = $requeteNbFormation->fetch();
		        $nbFormation = $valeurNbFormation['COUNT(ID_TYPE_FORMATION)'];
		        echo "<p> $nbFormation formation(s) : ";

		        // Affichage des formations
		        echo "<select name=\"idFormation\">";
		        for ($i=1; $i < ($nbFormation+1) ; $i++) {
		        	// Requête SQL préparé
		        	$requeteFormation = $db->prepare('SELECT * FROM TYPE_FORMATION WHERE ID_TYPE_FORMATION=:id');
		        	// On remplie les paramêtres
		            $requeteFormation->bindParam(':id', $i, PDO::PARAM_INT, 2);
		            // On l'éxécute
		            $requeteFormation->execute();
		            // On fetch Rigght !
		        	$valeurFormation = $requeteFormation->fetch();
		        	$idFormation = $valeurFormation['ID_TYPE_FORMATION'];
		        	$libelleFormation = $valeurFormation['LIBELLE'];
		        	echo "<option value=\"$idFormation\"> $libelleFormation</option>";
		        }
		        echo "</select> </p>";
    		?>
			
				 formateurs par date :<br /><br />
				<?php
				// FORMATEUR
		    	// Requête pour avoir le nombre de formateur
		    	$requeteNbFormateur = $db->query('SELECT COUNT(ID_FORMATEUR) FROM FORMATEUR');
		        $valeurNbFormateur = $requeteNbFormateur->fetch();
		        $nbFormateur = $valeurNbFormateur['COUNT(ID_FORMATEUR)'];
		        echo "<p> $nbFormateur formateur(s) : ";
				
				//affichage des formateur
				echo "<select name='option'>";
				for ($i=1; $i < ($nbFormateur+1) ; $i++) {
					// Requête SQL préparé
					$requeteFormateur = $db->prepare('SELECT * FROM FORMATEUR WHERE ID_FORMATEUR=:id');
					// On remplie les paramêtres
					$requeteFormateur->bindParam(':id', $i, PDO::PARAM_INT, 2);
					// On l'éxécute
					$requeteFormateur->execute();
					// On fetch Rigght !
					$valeurFormateur = $requeteFormateur->fetch();
					$idFormateur = $valeurFormateur['ID_FORMATEUR'];
					$libelleFormateur = $valeurFormateur['NOM'];
					$prenom = $valeurFormateur['PRENOM'];
					$salle = $valeurFormateur['ID_SALLE'];
					echo "<option value='$idFormateur'> $libelleFormateur $prenom - salle: $salle</option><br />";
				}
				echo "</select></p>";
				?>
			<p>
				<input type="submit" name="envoyer" value="afficher les formations" />
	     	</p>
		
		
		<br/>
		

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