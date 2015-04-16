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
		
		<?php
			try {
		        // Connexion à la base de données
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");
		        echo "<p>Connexion à la base réussi.</p> <br/>";
				
				$requeteCompte = $db->query('SELECT ID FROM STAGIAIRE;');
		        $requeteAffichage = $db->query('SELECT STAGIAIRE.ID AS id_stagiaire, STAGIAIRE.NOM AS nom_stagiaire, STAGIAIRE.PRENOM AS prenom_stagiaire, TYPE_FORMATION.LIBELLE AS formation, NATIONALITE.LIBELLE AS nationalite, FORMATEUR.NOM AS nom_formateur, FORMATEUR.PRENOM AS prenom_formateur, SALLE.LIBELLE AS salle, STAGIAIRE_FORMATEUR.DATE_DEBUT AS debut_formation,STAGIAIRE_FORMATEUR.DATE_FIN AS fin_formation
												FROM STAGIAIRE 
												LEFT JOIN TYPE_FORMATION 
												ON STAGIAIRE.ID_TYPE_FORMATION = TYPE_FORMATION.ID_TYPE_FORMATION
												LEFT JOIN NATIONALITE 
												ON STAGIAIRE.ID_NATIONALITE = NATIONALITE.ID_NATIONALITE
												LEFT JOIN STAGIAIRE_FORMATEUR
												ON STAGIAIRE.ID = STAGIAIRE_FORMATEUR.ID
												LEFT JOIN FORMATEUR
												ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = FORMATEUR.ID_FORMATEUR
												LEFT JOIN SALLE
												ON FORMATEUR.ID_SALLE = SALLE.ID_SALLE
												ORDER BY STAGIAIRE.ID;');
		        
		        //En cas de reussite
				$nbStagiaireUnique=$requeteCompte->rowCount();
				$nbStagiaire=$requeteAffichage->rowCount();
				$tabResult=$requeteAffichage->fetchAll(PDO::FETCH_ASSOC);
				echo "<p>Il y a $nbStagiaireUnique stagiaire(s)</p>";
				$titres=array_keys($tabResult[0]);
				echo "<table border=\"1\"><tr>";

				//Affichage des titres du tableau
				foreach($titres as $nomcol)
				{
					echo "<th>", htmlentities($nomcol), "</th>";
				}
				echo "</tr>";

				//Affichage des lignes de données
				for ($i=0; $i<$nbStagiaire; $i++)
				{
					echo "<tr>";
					foreach ($tabResult[$i] as $valeur)
					{
						echo "<td> $valeur </td>";
					}
					echo "</tr>";
				}
				echo "</table class='styletableau' border=\"1\"> <br />";

		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }
		?>

    	<form method="post" action="traitement-modification.php" class="formulaire-choix">
		
			<div class="formulaire-modification" >
			
				<div class="choix-id" >
					<p>Choix du stagiaire par ID: <br /><input type="text" name="id" /> <br /> </p>
				</div>
				
				<div class="modification-stagiaire" >
					<p>Choix des modifications: <br /> </p>
				</div>
				
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
			        	$id_type_formation = $valeurFormation['ID_TYPE_FORMATION'];
			        	$libelleFormation = $valeurFormation['LIBELLE'];
			        	echo "<option value=\"$id_type_formation\"> $libelleFormation</option>";
			        }
			        echo "</select> </p>";
	    		?>
				
				<p>Nom :	<br /><input type="text" name="nom" /> <br /> </p>
				<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
			
			</div>
	      
	      	<p>
				<input type="reset" value="Effacer" />
				<input type="submit" value="Envoyer" />
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