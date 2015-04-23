    <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/affichage-stagiaires.css" media="screen" />
        <title>Suppression des stagiaires </title>
    </head>

    <body>

    	<div class="titre">
    		<h1>Suppression des stagiaires </h1>
    	</div>

    	<?php
			try {
		        // Connexion à la base de données
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");
		        //echo "<p>Connexion à la base réussi.</p> <br/>";
		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }
		?>

		<form method="post" action="traitement-suppression.php" class="formulaire">

		<!--Tableau-->
		<table BORDER="1">

			<!--
				ligne <tr>
				titre <th>
				donnée <td>
			-->

			<tr><th>ID</th><th>NOM</th><th>PRENOM</th><th>FORMATION</th><th>NATIONALITE</th></tr>

			<?php
				/**************************************************************
					Principe de l'algorithme d'affichage :
					1) Compter le nombre de formation du stagiaire
					2) Récupérer l'ID MAX
					3) Faire un Do While tant qu'on est pas au dernier ID
						4) On test si l'ID est utilisé avec un IF isset id, sinon Else
							- Si oui on affiche les données de la table stagiaire
								on calcul son nombre de formation
									on affiche les données de ses formations
										on incrémente l'ID
							- Si non on passe un l'ID suivant
				***************************************************************/
			?>

			<?php
			echo '<br>';
			echo "<html><head><link rel='stylesheet' type='text/css' href='css/suppression-stagiaires.css' /><head><body>";
				//  1) Requête pour avoir le nombre de stagiaire(s)
				echo"<div class='affistag'>";
				$requeteNbStagiaire = $db->query('SELECT COUNT(ID) FROM STAGIAIRE');
			    $valeurNbStagiaire = $requeteNbStagiaire->fetch();
			    $nbStagiaire = $valeurNbStagiaire['COUNT(ID)'];
			    echo "<p> $nbStagiaire stagiaire(s) : ";
                echo" </div> ";
                echo '<br>';
			?>

			<?php
				// 2) Requête pour récupérer l'ID MAX
				$requeteIdMAX = $db->query('SELECT MAX(ID) FROM STAGIAIRE');
				$valeurIdMAX = $requeteIdMAX->fetch();
			    $IdMAX = $valeurIdMAX['MAX(ID)'];
			?>

			<?php

				// Do While
                echo "<html><head><link rel='stylesheet' type='text/css' href='css/suppression-stagiaires.css' /><head><body>";
				$id = 1;
				do {
					// requête pour tester l'existance de l'id stagiaire

						// Requête SQL préparé
						$requeteTestStagiaire = $db->prepare('SELECT ID FROM STAGIAIRE WHERE ID = :id');
						// On remplie les paramètres
            			$requeteTestStagiaire->bindParam(':id', $id, PDO::PARAM_INT, 2);
            			// On l'éxecute
            			$requeteTestStagiaire->execute();
            			// On récupère le nombre de ligne
            			$TestStagiaire = $requeteTestStagiaire->rowCount();
            		// Si le stagiaire existe, on affiche ses données
            		if ($TestStagiaire == 1) {

            			// Requête SQL préparé
            			$requeteAffichage = $db->prepare('SELECT STAGIAIRE.ID, STAGIAIRE.NOM, STAGIAIRE.PRENOM, TYPE_FORMATION.LIBELLE AS \'FORMATION\', NATIONALITE.LIBELLE AS \'NATIONALITE\'
            				FROM STAGIAIRE
            				LEFT JOIN TYPE_FORMATION
							ON STAGIAIRE.ID_TYPE_FORMATION = TYPE_FORMATION.ID_TYPE_FORMATION
							LEFT JOIN NATIONALITE
							ON STAGIAIRE.ID_NATIONALITE = NATIONALITE.ID_NATIONALITE
							WHERE ID = :id');
            			// On remplie les paramètres
            			$requeteAffichage->bindParam(':id', $id, PDO::PARAM_INT, 2);
            			// On l'exécute
            			$requeteAffichage->execute();
            			// On fetch Right !
		        		$valeurAffichage = $requeteAffichage->fetch();
		        		// Variables
		        		$prenomStagiaire = $valeurAffichage['NOM'];
		        		$nomStagiaire = $valeurAffichage['PRENOM'];
		        		$formationStagiaire = $valeurAffichage['FORMATION'];
		        		$nationaliteStagiaire = $valeurAffichage['NATIONALITE'];

		        		// Affichage dans le tableau

		        		echo "<tr> <td>$id</td> <td>$prenomStagiaire</td> <td>$nomStagiaire</td> <td>$formationStagiaire</td> <td>$nationaliteStagiaire</td> <td><INPUT type=radio name=\"id\" value=\"$id\"></td></tr>";

            		}
					// On incrémente l'id

            		$id++;
				} while ($id < ($IdMAX+1));

			?>

		</table>
        <br/>
		<!-- Bouton envoie formulaire -->
		<br /> <input type="submit" value="Valider la suppression" /> <br />
	</form>

		</br>
		<a href="index.php">Retour au menu</a>

		<?php
			if (isset($_GET['suppression'])) {
				if ($_GET['suppression']==1) {
					echo "<script>alert('Suppression du stagiaire réussi !')</script>";
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

    </body>
</html>
