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
				<input type="checkbox" name="option[]" value="1"/> Robert Dupond dans la salle 101, 	<?php
					// DATES
					// Requête pour avoir le nombre de dates de début
					$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=1');
					$valeurNbDates_debut = $requeteNbDates_debut->fetch();
					$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];
					echo "<p>$nbDates_debut dates début : ";

					// Affichage des dates début
					
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=1');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						echo "<select name=\"dates_debut\">";
						foreach ($valeurDate_debut as $value){
							
							$lol = $value['DATE_DEBUT'];
							echo "<option value=\"1\"> $lol </option>"; echo "<br />";
							
						}	
						echo "</select>";
				?>  <br />
				<input type="checkbox" name="option[]" value="2"/> Jean Martin dans la salle 102, <?php
					// DATES
					// Requête pour avoir le nombre de dates de début
					$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=2');
					$valeurNbDates_debut = $requeteNbDates_debut->fetch();
					$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];
					echo "<p>$nbDates_debut dates début : ";

					// Affichage des dates début
					
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=2');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						echo "<select name=\"dates_debut\">";
						foreach ($valeurDate_debut as $value){
							
							$lol = $value['DATE_DEBUT'];
							echo "<option value=\"1\"> $lol </option>"; echo "<br />";
							
						}	
						echo "</select>";
				?>   <br />
				<input type="checkbox" name="option[]" value="3"/> Paul Durand dans la salle 201, <?php
					// DATES
					// Requête pour avoir le nombre de dates de début
					$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=3');
					$valeurNbDates_debut = $requeteNbDates_debut->fetch();
					$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];
					echo "<p>$nbDates_debut dates début : ";

					// Affichage des dates début
					
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=3');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						echo "<select name=\"dates_debut\">";
						foreach ($valeurDate_debut as $value){
							
							$lol = $value['DATE_DEBUT'];
							echo "<option value=\"1\"> $lol </option>"; echo "<br />";
							
						}	
						echo "</select>";
				?> <br />
				<input type="checkbox" name="option[]" value="4"/> Alain Duval dans la salle 202, <?php
					// DATES
					// Requête pour avoir le nombre de dates de début
					$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=4');
					$valeurNbDates_debut = $requeteNbDates_debut->fetch();
					$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];
					echo "<p>$nbDates_debut dates début : ";

					// Affichage des dates début
					
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=4');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						echo "<select name=\"dates_debut\">";
						foreach ($valeurDate_debut as $value){
							
							$lol = $value['DATE_DEBUT'];
							echo "<option value=\"1\"> $lol </option>"; echo "<br />";
							
						}	
						echo "</select>";
				?> 
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
		?>
    
    </body>
</html>