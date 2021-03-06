<?php

    // Enregistrement des variables à partir du formulaire
    $id = $_POST['id'];
	$id_type_formation = $_POST['id_type_formation'];
	$id_nationalite = $_POST['id_nationalite'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];

	if ($id!='') {

    	try {
            // Connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion à la base réussi. <br/>";

			// Requête SQL préparé
			$requeteValues = $db->prepare('SELECT STAGIAIRE.NOM, STAGIAIRE.PRENOM, TYPE_FORMATION.ID_TYPE_FORMATION AS \'FORMATION\', NATIONALITE.ID_NATIONALITE AS \'NATIONALITE\'
				FROM STAGIAIRE
				LEFT JOIN TYPE_FORMATION
				ON STAGIAIRE.ID_TYPE_FORMATION = TYPE_FORMATION.ID_TYPE_FORMATION
				LEFT JOIN NATIONALITE
				ON STAGIAIRE.ID_NATIONALITE = NATIONALITE.ID_NATIONALITE
				WHERE ID = :id');
			// On remplie les paramètres
			$requeteValues->bindParam(':id', $id, PDO::PARAM_INT, 2);
			// On l'exécute
			$requeteValues->execute();
			// On fetch Right !
			$valeurValues = $requeteValues->fetch();

			if($id_type_formation == 0)
			{
				$id_type_formation = $valeurValues['FORMATION'];
			}

			if($id_nationalite == 0)
			{
				$id_nationalite = $valeurValues['NATIONALITE'];
			}

			if($prenom == "")
			{
				$prenom = $valeurValues['PRENOM'];
			}

			if($nom == "")
			{
				$nom = $valeurValues['NOM'];
			}

			// Requête SQL préparé
            $requeteModification = $db->prepare('UPDATE STAGIAIRE
												SET ID_TYPE_FORMATION=:id_type_formation,
												ID_NATIONALITE=:id_nationalite,
												NOM=:nom,
												PRENOM=:prenom
												WHERE ID=:id');


            // On remplie les paramètres
            $requeteModification->bindParam(':id', $id, PDO::PARAM_INT, 2);
			$requeteModification->bindParam(':id_type_formation', $id_type_formation, PDO::PARAM_INT, 2);
			$requeteModification->bindParam(':nom', $nom, PDO::PARAM_STR, 2);
			$requeteModification->bindParam(':id_nationalite', $id_nationalite, PDO::PARAM_INT, 2);
			$requeteModification->bindParam(':prenom', $prenom, PDO::PARAM_STR, 2);

            // On l'exécute
            $requeteModification->execute();
            echo "Stagiaire modifié avec succés !";

            // Redirection
            header('Location: modification-stagiaire.php?modification=1');
        }
        catch (PDOException $e) {
        	echo "Erreur : " . $e->getMessage() . "<br/>";
        	die();
        }
    }
    else {
        header('Location: modification-stagiaire.php?erreur=1');
    }

?>
