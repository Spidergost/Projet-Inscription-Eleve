	    	<?php
				// Connection a la base
				try {
					// Connexion � la base de donn�es
					$db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
					// prise en charge de l'utf-8
					$db->exec("SET CHARACTER SET utf8");
					echo "Connexion � la base r�ussi. <br/>";
				}
				catch (PDOException $e) {
					echo "Erreur : " . $e->getMessage() . "<br/>";
					die();
				}
					$idFormation = $_POST['idFormation'];
					//lecture du tableau option[]
					$option = $_POST['option'];
					//$id_formateur = implode(', ',$option);
					//echo '<p>options:<br><br>'.$id_formateur.'</p>';
					$id_formateur = $option; 
					// Dates d�but
					if($idFormation!='')
					{
					
						// Requ�te pour avoir le nombre de dates de d�but
						$requeteNbDates_debut = $db->query('SELECT COUNT(DATE_DEBUT) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
						$valeurNbDates_debut = $requeteNbDates_debut->fetch();
						$nbDates_debut = $valeurNbDates_debut['COUNT(DATE_DEBUT)'];
						echo "<p>$nbDates_debut dates d�but : ";

						// Affichage des dates d�but				
						// Requ�te SQL pr�par�
						$requeteDates_debut = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR LEFT JOIN TYPE_FORMATION_FORMATEUR ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR WHERE ID_TYPE_FORMATION=' . $idFormation . ' AND STAGIAIRE_FORMATEUR.ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les param�tres
						$requeteDates_debut->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'�x�cute
						$requeteDates_debut->execute();
						// On fetch Rigght !
						$valeurDate_debut = $requeteDates_debut->fetchAll();
						foreach ($valeurDate_debut as $value){
										
							$date_debut = $value['DATE_DEBUT'];
							 echo "<br />";echo "$date_debut";
										
						}
						//Date fin
						//requ�te pour avoir le nombre de dates � la fin
						$requeteNbDates_fin = $db->query('SELECT COUNT(DATE_FIN) FROM STAGIAIRE_FORMATEUR WHERE ID_FORMATEUR=' . $id_formateur . '');
						$valeurNbDates_fin = $requeteNbDates_fin->fetch();
						$nbDates_fin = $valeurNbDates_fin['COUNT(DATE_FIN)'];
						echo "<p>$nbDates_fin dates de fin : ";

						// Affichage des dates d�but				
						// Requ�te SQL pr�par�
						$requeteDates_fin = $db->prepare('SELECT * FROM STAGIAIRE_FORMATEUR LEFT JOIN TYPE_FORMATION_FORMATEUR ON STAGIAIRE_FORMATEUR.ID_FORMATEUR = TYPE_FORMATION_FORMATEUR.ID_FORMATEUR WHERE ID_TYPE_FORMATION=' . $idFormation . ' AND STAGIAIRE_FORMATEUR.ID_FORMATEUR=' . $id_formateur . '');
						// On remplie les param�tres
						$requeteDates_fin->bindParam(':id_formateur', $i, PDO::PARAM_STR, 20);
						// On l'�x�cute
						$requeteDates_fin->execute();
						// On fetch Rigght !
						$valeurDate_fin = $requeteDates_fin->fetchAll();
						foreach ($valeurDate_fin as $value){
										
							$date_fin = $value['DATE_FIN'];
							 echo "<br />"; echo "$date_fin";
										
						}
					}
		?>