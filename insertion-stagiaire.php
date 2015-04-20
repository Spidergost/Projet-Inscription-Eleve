<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/insertion-stagiaire.css" media="screen" />
        <title>Insertion de stagiaire</title>
    </head>

    <body>

    	<div class="titre">
    		<h1> Insérer un stagiaire en formation </h1>
    	</div>

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

    	<form method="post" action="traitement-insertion.php" class="formulaire">

	    	<p>Nom : <br /><input type="text" name="nom" /> <br /> </p>
		  	<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>

	      	<?php
		        // NATIONALITE
		    	// Requête pour avoir le nombre de nationalite

		    	$requeteNbNationalite = $db->query('SELECT COUNT(ID_NATIONALITE) FROM NATIONALITE');
		        $valeurNbNationalite = $requeteNbNationalite->fetch();
		        $nbNationalite = $valeurNbNationalite['COUNT(ID_NATIONALITE)'];
		        echo "<p>$nbNationalite nationalité(s) : ";

		        // Affichage des nationalites
		        echo "<select name=\"nationalite\">";
		        for ($i=1; $i < ($nbNationalite+1) ; $i++) {
		        	// Requête SQL préparé
		        	$requeteNationalite = $db->prepare('SELECT * FROM NATIONALITE WHERE ID_NATIONALITE=:id');
		        	// On remplie les paramètres
		            $requeteNationalite->bindParam(':id', $i, PDO::PARAM_INT, 2);
		            // On l'éxécute
		            $requeteNationalite->execute();
		            // On fetch Rigght !
		        	$valeurNationalite = $requeteNationalite->fetch();
		        	$idNationalite = $valeurNationalite['ID_NATIONALITE'];
		        	$libelleNationalite = $valeurNationalite['LIBELLE'];
		        	echo "<option value=\"$idNationalite\"> $libelleNationalite</option>";
		        }
		        echo "</select> </p>";
    		?>

            <font size="2"><a href="ajout-nationalite.php"> Souhaitez-vous ajouter une nationalité ? </a></font>

    		<?php
		        // FORMATION
		    	// Requête pour avoir le nombre de formation
		    	$requeteNbFormation = $db->query('SELECT COUNT(ID_TYPE_FORMATION) FROM TYPE_FORMATION');
		        $valeurNbFormation = $requeteNbFormation->fetch();
		        $nbFormation = $valeurNbFormation['COUNT(ID_TYPE_FORMATION)'];
		        echo "<p> $nbFormation formation(s) : ";

		        // Affichage des formations
		        echo "<select name=\"formation\">";
		        for ($i=1; $i < ($nbFormation+1) ; $i++) {
		        	// Requête SQL préparé
		        	$requeteFormation = $db->prepare('SELECT * FROM TYPE_FORMATION WHERE ID_TYPE_FORMATION=:id');
		        	// On remplie les paramètres
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
			
			<font size="2"><a href="ajout-formation-formateur.php"> Souhaitez-vous ajouter un foramteur et une formation ? </a></font>
	      	
			<p>
				<input type="submit" value="Valider l'insertion" />
	     	</p>
    	</form>

    	<a href="index.php">Retour au menu</a>

		<?php
    		// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['nationalite'])) {
				if ($_GET['nationalite']==1) {
					echo "<script>alert('Nationalité ajoutée avec succès !')</script>";
				}
			}
		?>

    		<?php
    		// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur']==1) {
					echo "<script>alert('Veuillez remplir le formulaire en entier.')</script>";
				}
			}
		?>
		
		<?php
		// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['insertion'])) {
				if ($_GET['insertion']==1) {
					echo "<script>alert('Insertion de stagiaire réussi !')</script>";
			}
		}
		?>
    </body>
</html>
