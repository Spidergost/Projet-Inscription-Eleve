<?php
			try {
		        // Connexion � la base de donn�es
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");
		        //echo "<p>Connexion � la base r�ussi.</p> <br/>";
				
				$requeteCompte = $db->query('SELECT ID FROM STAGIAIRE;');
		        $requeteAffichage = $db->query('SELECT STAGIAIRE.ID AS "Id Stagiaire",
												STAGIAIRE.NOM AS "Nom Stagiaire",
												STAGIAIRE.PRENOM AS "Prenom Stagiaire",
												TYPE_FORMATION.LIBELLE AS "Formation",
												NATIONALITE.LIBELLE AS "Nationalite",
												FORMATEUR.NOM AS "Nom Formateur",
												FORMATEUR.PRENOM AS "Prenom Formateur",
												SALLE.LIBELLE AS "Salle",
												STAGIAIRE_FORMATEUR.DATE_DEBUT AS "Debut Formation",
												STAGIAIRE_FORMATEUR.DATE_FIN AS "Fin Formation"
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

				//Affichage des lignes de donn�es
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