<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Liste des stagiaires</title>
    </head>

    <body>

    	<h1>Liste des stagiaires : </h1>

		<?php
			try {
		        // Connexion à la base de données
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");
		        echo "<p>Connexion à la base réussi.</p> <br/>";

		        $requeteAffichage = $db->query('SELECT ID, NOM, PRENOM, TYPE_FORMATION.LIBELLE AS Formation, NATIONALITE.LIBELLE AS Nationalite 
		        		FROM STAGIAIRE 
		        		LEFT JOIN TYPE_FORMATION 
		        		ON STAGIAIRE.ID_TYPE_FORMATION = TYPE_FORMATION.ID_TYPE_FORMATION
		        		LEFT JOIN NATIONALITE 
		        		ON STAGIAIRE.ID_NATIONALITE = NATIONALITE.ID_NATIONALITE');

		        //En cas de reussite
				$nbStagiaire=$requeteAffichage->rowCount();
				$tabResult=$requeteAffichage->fetchAll(PDO::FETCH_ASSOC);
				echo "<p>Il y a $nbStagiaire stagiaires(s)</p>";
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
				echo "</table> <br />";

		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }
		?>

		<a href="index.php">Retour au menu</a>
	</body>
</html>
