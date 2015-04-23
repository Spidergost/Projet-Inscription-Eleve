<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/req-affichage-stagiaires.css" media="screen" />
	</head>

		<body>
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
            <br/>
			<div class="tableau">
				<!--Tableau-->
				<table BORDER="1">

				<!--
					ligne <tr>
					titre <th>
					donnée <td>
				-->

					<tr><th>ID</th><th>NOM</th><th>PRENOM</th><th>FORMATION</th><th>NATIONALITE</th><th>Formateur - Salle - Date début - Date fin</th></tr>

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
					//  1) Requête pour avoir le nombre de stagiaire(s)
						$requeteNbStagiaire = $db->query('SELECT COUNT(ID) FROM STAGIAIRE');
						$valeurNbStagiaire = $requeteNbStagiaire->fetch();
						$nbStagiaire = $valeurNbStagiaire['COUNT(ID)'];
						echo "<p><b><u> $nbStagiaire stagiaire(s)</u> :</b> ";
                        echo '<br>';
					?>

					<?php
                        echo '<br>';
						// 2) Requête pour récupérer l'ID MAX
						$requeteIdMAX = $db->query('SELECT MAX(ID) FROM STAGIAIRE');
						$valeurIdMAX = $requeteIdMAX->fetch();
						$IdMAX = $valeurIdMAX['MAX(ID)'];
					?>

					<?php
						// Do While
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
								// On l'éxecute
								$requeteAffichage->execute();
								// On fetch Rigght !
								$valeurAffichage = $requeteAffichage->fetch();
								// Variables
								$prenomStagiaire = $valeurAffichage['NOM'];
								$nomStagiaire = $valeurAffichage['PRENOM'];
								$formationStagiaire = $valeurAffichage['FORMATION'];
								$nationaliteStagiaire = $valeurAffichage['NATIONALITE'];


								// Affichage dans le tableau
								echo "<tr> <td>$id</td> <td>$prenomStagiaire</td> <td>$nomStagiaire</td> <td>$formationStagiaire</td> <td>$nationaliteStagiaire</td> ";

								// Affichage des formations
								$requeteFormation = $db->prepare('SELECT FORMATEUR.NOM, SALLE.LIBELLE AS SALLE, STAGIAIRE_FORMATEUR.DATE_DEBUT, STAGIAIRE_FORMATEUR.DATE_FIN
									FROM STAGIAIRE_FORMATEUR
									LEFT JOIN FORMATEUR
									ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = FORMATEUR.ID_FORMATEUR
									LEFT JOIN SALLE
									ON FORMATEUR.ID_SALLE = SALLE.ID_SALLE
									WHERE ID = :id');
								$requeteFormation->bindParam(':id', $id, PDO::PARAM_INT, 2);
								$requeteFormation->execute();
								$valeurFormation = $requeteFormation->fetchAll();

								echo "<td>";

								foreach($valeurFormation as $ligne) {
								echo $ligne['NOM'] . " - ";
								echo $ligne['SALLE'] . " - ";
								echo $ligne['DATE_DEBUT'] . " - ";
								echo $ligne['DATE_FIN'] . "<br />";
								}

								echo "</td>";

								// On finis la ligne
								echo "</tr>";

							}

							// On incrémente l'id
							$id++;

						} while ($id < ($IdMAX+1));
					?>

				</table>

			</div>

            

		</body>
</html>
