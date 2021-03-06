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
					//echo "Connexion à la base réussi. <br/>";
				}
				catch (PDOException $e) {
					echo "Erreur : " . $e->getMessage() . "<br/>";
					die();
				}
			?>
    	<div class="titre">
    		<h1> Listing en fonction des formations </h1>
    	</div>
    	    <br />
    	    <b><u>Les formations</u> :</b><br /><br />
			
    		<?php
		        // FORMATION
		    	// Requête pour avoir le nombre de formation
		    	$requeteNbFormation = $db->query('SELECT COUNT(ID_TYPE_FORMATION) FROM TYPE_FORMATION');
		        $valeurNbFormation = $requeteNbFormation->fetch();
		        $nbFormation = $valeurNbFormation['COUNT(ID_TYPE_FORMATION)'];
		        //echo "<p> $nbFormation formation(s) : ";
				
				// FORMATEUR
		    	// Requête pour avoir le nombre de formateur
		    	$requeteNbFormateur = $db->query('SELECT COUNT(ID_FORMATEUR) FROM FORMATEUR');
		        $valeurNbFormateur = $requeteNbFormateur->fetch();
		        $nbFormateur = $valeurNbFormateur['COUNT(ID_FORMATEUR)'];
				
		        // Affichage des formations
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
					echo "<b><u> $libelleFormation </u> :</b><br /><br />";
					
					//Nombre de Formateur dans la Formation à $i
					/*$requeteFormateurNb = $db->prepare('SELECT NOM, PRENOM, DATE_DEBUT_FORMATION, DATE_FIN_FORMATION
													  FROM FORMATEUR
													  LEFT JOIN TYPE_FORMATION_FORMATEUR ON FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR
													  WHERE TYPE_FORMATION_FORMATEUR.ID_TYPE_FORMATION = :id');
					// On remplie les paramêtres
					$requeteFormateurNb->bindParam(':id', $i, PDO::PARAM_INT, 2);
					// On l'éxécute
					$requeteFormateurNb->execute();
					$nbFormaSpec = $requeteFormateurNb->rowCount();
					echo $nbFormaSpec;
					for ($y = 0; $y < $nbFormaSpec; $y++) {*/
						$requeteFormateur = $db->prepare('SELECT NOM, PRENOM, DATE_DEBUT_FORMATION, DATE_FIN_FORMATION, ID_SALLE
														FROM FORMATEUR
														LEFT JOIN TYPE_FORMATION_FORMATEUR ON FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR
														WHERE TYPE_FORMATION_FORMATEUR.ID_TYPE_FORMATION = :id');
						// On remplie les paramêtres
						$requeteFormateur->bindParam(':id', $i, PDO::PARAM_INT, 2);
						// On l'éxécute
						$requeteFormateur->execute();
						// On fetch Rigght !
						$valeurFormateur = $requeteFormateur->fetchAll();
						$nblignes = $requeteFormateur->rowCount();
						
						if ($nblignes != 0) {
							echo "<table BORDER = \"1\">";
							
							echo "<tr><th>NOM</th><th>PRENOM</th><th>DATE DE DEBUT</th><th>DATE DE FIN</th> <th>ID SALLE</th> </tr>";
							
							foreach($valeurFormateur as $ligne) {
									echo "<tr> <td>" . $ligne['NOM'] . "</td>";
									echo "<td>" . $ligne['PRENOM'] . "</td>";
									echo "<td>" . $ligne['DATE_DEBUT_FORMATION'] . "</td>";
									echo "<td>" . $ligne['DATE_FIN_FORMATION'] . "</td>";
									echo "<td>" . $ligne['ID_SALLE'] . "</td> </tr>";
									echo "<br />";
									}
							echo "</table>";
						}
						else {
							echo "Aucune formations disponible";
							echo "<br />";
						}
					//}
				}

    		?>
                 <br />
				 
				<br/>
				<font size="2"><a href="ajout-formation-formateur-affichage-formateur.php"> Souhaitez-vous ajouter un formateur et une formation ? </a></font>


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
