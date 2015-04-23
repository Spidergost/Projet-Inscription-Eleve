<?php
session_start();
$idFormation = isset($_POST['idFormation']);
$option = isset($_POST['option']);
$id_formateur = $option;
$nom = isset($_POST['nom']);
$prenom = isset($_POST['prenom']);
$idNationalite = isset($_POST['idNationalite']);
?>
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

    	<form method="post" action="assemblageV2test.php" class="formulaire">
	
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
		        echo "<select name=\"idNationalite\">";
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
		        echo "<select name=\"idFormation\">";
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
				<font size="2"><a href="ajout-formation-formateur-assemblage.php"> Souhaitez-vous ajouter un formateur et une formation ? </a></font>
				<br />
				
				formateurs par date :<br /><br />

		
			<p>	
				<input type="submit" name="envoyer" value="afficher les formations" />
	     	</p>
				<input type="submit" name="envoyer" value="envoyer" />
    	</form>
		
		<?php		
		if($_POST['envoyer']=='afficher les formations'){
					$idFormation = $_POST['idFormation'];
					//lecture du tableau option[]
					$option = $_POST['option'];
					//$id_formateur = implode(', ',$option);
					//echo '<p>options:<br><br>'.$id_formateur.'</p>';
					$id_formateur = $option; 
					// Dates début
					if($idFormation!='')
					{
					
						// Requête pour avoir le nombre de dates de début
						$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT_FORMATION) FROM TYPE_FORMATION_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . ' AND ID_TYPE_FORMATION=' . $idFormation . '');
						$valeurNbDates_debut = $requeteNbDates_debut->fetch();
						$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT_FORMATION)'];
						echo "<p>$nbDates_debut dates début : ";

						// Affichage des dates début
						echo "<select name='date_debut'>";
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR LEFT JOIN TYPE_FORMATION_FORMATEUR ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR WHERE ID_TYPE_FORMATION=' . $idFormation . ' AND STAGIAIRE_FORMATEUR.ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						foreach ($valeurDate_debut as $value){
										
							$date_debut = $value['DATE_DEBUT'];
							 echo "<option value='$date_debut'> $date_debut</option><br />";										
						}
						echo "</select></p>";
						//Date fin
						//requête pour avoir le nombre de dates à la fin
						$requeteNbDates_fin = $db->query('SELECT COUNT(DATE_FIN_FORMATION) FROM TYPE_FORMATION_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . ' AND ID_TYPE_FORMATION=' . $idFormation . '');
						$valeurNbDates_fin = $requeteNbDates_fin->fetch();
						$nbDates_fin = $valeurNbDates_fin['COUNT(DATE_FIN_FORMATION)'];
						echo "<p>$nbDates_fin dates de fin : ";

						// Affichage des dates de fin
						echo "<select name='date_fin'>";						
						// Requête SQL préparé
						$requeteDates_fin = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR LEFT JOIN TYPE_FORMATION_FORMATEUR ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR WHERE ID_TYPE_FORMATION=' . $idFormation . ' AND STAGIAIRE_FORMATEUR.ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les paramètres
						$requeteDates_fin->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_fin->execute();
						// On fetch Rigght !
						$valeurDate_fin = $requeteDates_fin->fetchAll();
						foreach ($valeurDate_fin as $value){
										
							$date_fin = $value['DATE_FIN'];
							echo "<option value='$date_fin'> $date_fin</option><br />";			
						}
						echo "</select></p>";
					}
			
		 }
		 else{
			if($_POST['envoyer']==('envoyer')) {
			// appel du traitement
			// Enregistrement des variables à partir du formulaire
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$idNationalite = $_POST['idNationalite'];
				$idFormation = $_POST['idFormation'];
				$option = $_POST['option'];
				
							// Connection a la base
							try {
								// Connexion à la base de données
								$db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
								// prise en charge de l'utf-8
								$db->exec("SET CHARACTER SET utf8");
							}
							catch (PDOException $e) {
								echo "Erreur : " . $e->getMessage() . "<br/>";
								die();
							}
					//lecture du tableau option[]
					$option = $_POST['option'];
					//$id_formateur = implode(', ',$option);
					//echo '<p>options:<br><br>'.$id_formateur.'</p>';
					
					// Dates début
					// Requête pour avoir le nombre de dates de début
					$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
					$valeurNbDates_debut = $requeteNbDates_debut->fetch();
					$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];

						// Affichage des dates début				
						// Requête SQL préparé
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les paramètres
						$requeteDates_debut->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						foreach ($valeurDate_debut as $value){
							$date_debut = $value['DATE_DEBUT'];
						}

					//Date fin
					//requête pour avoir le nombre de dates à la fin
					$requeteNbDates_fin = $db->query('SELECT COUNT(DATE_FIN) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
					$valeurNbDates_fin = $requeteNbDates_fin->fetch();
					$nbDates_fin = $valeurNbDates_fin['COUNT(DATE_FIN)'];

						// Affichage des dates début				
						// Requête SQL préparé
						$requeteDates_fin = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les paramètres
						$requeteDates_fin->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'éxécute
						$requeteDates_fin->execute();
						// On fetch Rigght !
						$valeurDate_fin = $requeteDates_fin->fetchAll();
						foreach ($valeurDate_fin as $value){
							$date_fin = $value['DATE_FIN'];				
						}						
					 
				if ( ($nom!='') && ($prenom!='') && ($idNationalite!='') && ($idFormation!='') && ($id_formateur!='') && ($date_debut!='') && ($date_fin!='') ) {

					try {
						// Connexion à la base de données
						$db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
						// prise en charge de l'utf-8
						$db->exec("SET CHARACTER SET utf8");
						echo "<br/>";
						echo "Connexion à la base réussi. <br/>";
						
						// On calcul l'Id à mettre au nouveau stagiaire (l'id max précédent + 1)
						$requeteId = $db->query('SELECT MAX(ID) as IdMAX FROM STAGIAIRE');
						$valeurId = $requeteId->fetch();
						$id = $valeurId['IdMAX'];
						//echo "La variable \$id vaut : " . $id . "<br />";
						$id++;
						//echo "Elle vaut maintenant : " . $id . "<br />";

						// Requête SQL préparé
						$requeteInsertion = $db->prepare('INSERT INTO STAGIAIRE (ID, NOM, PRENOM, ID_NATIONALITE, ID_TYPE_FORMATION) 
							VALUES (:id, :nom, :prenom, :idNationalite, :idFormation)');
						// requête SQL préparé
						$requeteInsertion2 = $db->prepare('INSERT INTO STAGIAIRE_FORMATEUR (ID, ID_FORMATEUR, DATE_DEBUT, DATE_FIN)
							VALUES (:id, :id_formateur, :date_debut, :date_fin)');
						// On remplie les paramètres
						$requeteInsertion->bindParam(':id', $id, PDO::PARAM_INT, 2);
						$requeteInsertion->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
						$requeteInsertion->bindParam(':prenom', $prenom, PDO::PARAM_STR, 20);
						$requeteInsertion->bindParam(':idNationalite', $idNationalite, PDO::PARAM_INT, 2);
						$requeteInsertion->bindParam(':idFormation', $idFormation, PDO::PARAM_INT, 2);
						//execution de la requête 1
						
						$requeteInsertion->execute();
						$requeteInsertion2->bindParam(':id', $id, PDO::PARAM_INT, 2);
						$requeteInsertion2->bindParam(':id_formateur', $id_formateur, PDO::PARAM_STR, 20);
						$requeteInsertion2->bindParam(':date_debut', $date_debut, PDO::PARAM_STR, 20);
						$requeteInsertion2->bindParam(':date_fin', $date_fin, PDO::PARAM_STR, 20);

						//execution requête 2
						$requeteInsertion2->execute();
						
						//confirmation
						echo "Stagiaire ajouté avec succès !";

						
					}
					catch (PDOException $e) {
						echo "Erreur : " . $e->getMessage() . "<br/>";
						die();
					}
					// Redirection
					//header('Location: index.php?ajoute=1');
				}
				else {
					//header('Location: assemblage.php?erreur=1');
				}
    					
			}
		}
		?>
		
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
