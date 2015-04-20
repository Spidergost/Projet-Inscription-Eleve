<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/modification-stagiaire.css" media="screen" />
        <title>Modification d'un Stagiaire</title>
    </head>

    <body>
	
		<div class="titre">
			<a > <h1> Modification d'un Stagiaire </h1> </a>
		</div>
		
		<?php include('req-affichage-stagiaires.php'); ?>

    	<form method="post" action="traitement-modification.php" class="formulaire-choix">
		
			<div class="formulaire-modification" >
			
				<div class="choix-id" >
					<p>Choix du stagiaire par ID: <br /><input type="text" name="id" /> <br /> </p>
				</div>
				
				<div class="modification-stagiaire" >
					<p>Choix des modifications: <br /> </p>
				</div>
				
				<p>Nom :	<br /><input type="text" name="nom" /> <br /> </p>
				<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
				
				<?php
			        // NATIONALITE
			    	// Requête pour avoir le nombre de nationalite
			    	$requeteNbNationalite = $db->query('SELECT COUNT(ID_NATIONALITE) FROM NATIONALITE');
			        $valeurNbNationalite = $requeteNbNationalite->fetch();
			        $nbNationalite = $valeurNbNationalite['COUNT(ID_NATIONALITE)'];
			        echo "<p>$nbNationalite nationalité(s) : ";

			        // Affichage des nationalites
			        echo "<select name=\"id_nationalite\">";
			        for ($i=1; $i < ($nbNationalite+1) ; $i++) { 
			        	// Requête SQL préparé
			        	$requeteNationalite = $db->prepare('SELECT * FROM NATIONALITE WHERE ID_NATIONALITE=:id');
			        	// On remplie les paramètres
			            $requeteNationalite->bindParam(':id', $i, PDO::PARAM_INT, 2);
			            // On l'éxécute
			            $requeteNationalite->execute();
			            // On fetch Rigght !
			        	$valeurNationalite = $requeteNationalite->fetch();
			        	$id_nationalite = $valeurNationalite['ID_NATIONALITE'];
			        	$libelleNationalite = $valeurNationalite['LIBELLE'];
			        	echo "<option value=\"$id_nationalite\"> $libelleNationalite</option>";
			        }
			        echo "</select> </p>";
    			?>
	      	
	    		<?php
			        // FORMATION
			    	// Requête pour avoir le nombre de formation
			    	$requeteNbFormation = $db->query('SELECT COUNT(ID_TYPE_FORMATION) FROM TYPE_FORMATION');
			        $valeurNbFormation = $requeteNbFormation->fetch();
			        $nbFormation = $valeurNbFormation['COUNT(ID_TYPE_FORMATION)'];
			        echo "<p> $nbFormation formation(s) : ";

			        // Affichage des formations
			        echo "<select name=\"id_type_formation\">";
			        for ($i=1; $i < ($nbFormation+1) ; $i++) { 
			        	// Requête SQL préparé
			        	$requeteFormation = $db->prepare('SELECT * FROM TYPE_FORMATION WHERE ID_TYPE_FORMATION=:id');
			        	// On remplie les paramètres
			            $requeteFormation->bindParam(':id', $i, PDO::PARAM_INT, 2);
			            // On l'éxécute
			            $requeteFormation->execute();
			            // On fetch Rigght !
			        	$valeurFormation = $requeteFormation->fetch();
			        	$id_type_formation = $valeurFormation['ID_TYPE_FORMATION'];
			        	$libelleFormation = $valeurFormation['LIBELLE'];
			        	echo "<option value=\"$id_type_formation\"> $libelleFormation</option>";
			        }
			        echo "</select> </p>";
	    		?>
			
			</div>
	      
	      	<p>
				<input type="reset" value="Effacer le formulaire" />
				<input type="submit" value="Modifier le stagiaire" />
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
