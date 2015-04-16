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
			
            // On l'éxecute
            $requeteModification->execute();
            echo "Stagiaire modifié avec succés avec succès !";

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