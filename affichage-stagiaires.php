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
		    }
		    catch (PDOException $e) {
		    	echo "Erreur : " . $e->getMessage() . "<br/>";
		    	die();
		    }
		?>

		<a href="index.php">Retour au menu</a>
	</body>
</html>
