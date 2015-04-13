<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/affichage-stagiaires.css" media="screen" />
    </head>

    <body>
		<div class="titre">
			<a > <h1> Suppression de Stagiaire</h1> </a>
		</div>
		<?php
			try {
		        // Connexion à la base de données
		        $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
		        // prise en charge de l'utf-8
		        $db->exec("SET CHARACTER SET utf8");
		        echo "<p>Connexion à la base réussi.</p> <br/>";
				
				
		        $requeteAffichage = $db->query('SELECT STAGIAIRE.ID AS id_stagiaire, STAGIAIRE.NOM AS nom_stagiaire, STAGIAIRE.PRENOM AS prenom_stagiaire, NATIONALITE.LIBELLE AS nationalite
												FROM STAGIAIRE 
												LEFT JOIN TYPE_FORMATION 
												ON STAGIAIRE.ID_TYPE_FORMATION = TYPE_FORMATION.ID_TYPE_FORMATION
												LEFT JOIN NATIONALITE 
												ON STAGIAIRE.ID_NATIONALITE = NATIONALITE.ID_NATIONALITE
												ORDER BY STAGIAIRE.ID;');
												
		        //En cas de reussite
				$nbStagiaire=$requeteAffichage->rowCount();
				$tabResult=$requeteAffichage->fetchAll(PDO::FETCH_ASSOC);
				echo "<p>Il y a $nbStagiaire stagiaire(s)</p>";
				$titres=array_keys($tabResult[0]);
				echo "<table border=\"1\"><tr>";

				//Affichage des titres du tableau
				foreach($titres as $nomcol)
				{
					echo "<th>", htmlentities($nomcol), "</th>";
				}
				echo "</tr>";

				//Affichage des lignes de données
				
				<form action="traitement-suppression.php" class="formulaire">
					for ($i=0; $i<$nbStagiaire; $i++)
					{
						echo "<tr>";
						foreach ($tabResult[$i] as $valeur)
						{
							$stagiaireCB= "CB";
							$stagiaireCB .= $i;
							echo "<td> $valeur </td>";
							echo "<td> <input type='checkbox' name='$stagiaireCB[]' value='$i'>";
						}
						echo "</tr>";
					}
				
				echo "</table class='styletableau' border=\"1\"> <br />";
				</form>
		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }
		?>	
    	<form method="post" action="traitement-suppression.php" class="formulaire">
	    	<p>
				<input type="submit" value="Supprimer le stagiaire" />
	     	</p>
    	</form>

    	<?php
    		// Lancement script JS de confirmation pour la suppression de stagiaire.
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur']==1) {
					echo "<script>alert('Veuillez selectionner un id à supprimer')</script>";
				}
			}	
		?>
    <a href="index.php">Retour au menu</a>
    </body>
</html>