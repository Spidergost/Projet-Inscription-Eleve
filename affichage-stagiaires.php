<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/affichage-stagiaires.css" media="screen" />
        <title>Liste des stagiaires</title>
    </head>

    <body>
	<div class="titre">
    	<h1>Liste des stagiaires : </h1>
        </div>

		<?php

    echo "<html><head><link rel='stylesheet' type='text/css' href='css/affichage-stagiaires.css' /><head><body>";
		//print('<link rel="stylesheet" href="css/affichage-stagiaires.css" type="text/css">');

			try {
		        // Connexion à la base de données
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");

		       // echo "<p>Connexion à la base réussi.</p> <br/>";

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
		        echo"<div class='affistag'>";
				$nbStagiaireUnique=$requeteCompte->rowCount();
				$nbStagiaire=$requeteAffichage->rowCount();
				$tabResult=$requeteAffichage->fetchAll(PDO::FETCH_ASSOC);
				echo "<p>Il y a $nbStagiaireUnique stagiaire(s)</p>";
				 echo" </div> ";
				 echo"<div class='tableau'>";
				$titres=array_keys($tabResult[0]);
				echo "<table border=\"1\"><tr>";

				//Affichage des titres du tableau
				foreach($titres as $nomcol)
				{
					echo "<th>", htmlentities($nomcol), "</td>";
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
                echo" </div> ";
		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }

		?>
        </br>
		<a href="index.php">Retour au menu</a>

	</body>
</html>
