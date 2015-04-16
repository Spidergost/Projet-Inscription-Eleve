<?php

    // Enregistrement des variables à partir du formulaire
    $id = $_POST['id'];

	if ($id!='') {

    	try {
            // Connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion à la base réussi. <br/>";
            
			/* 1ère requete */
			
            // Requête SQL préparé
            $requeteSuppression = $db->prepare('DELETE FROM STAGIAIRE WHERE ID = :id');
            // On remplie les paramètres
            $requeteSuppression->bindParam(':id', $id, PDO::PARAM_INT, 2);
            // On l'éxecute
            $requeteSuppression->execute();
			
			/* 2ème requete */
			$requeteSuppression2 = $db->prepare('DELETE FROM STAGIAIRE_FORMATEUR WHERE ID = :id');
			$requeteSuppression2->bindParam( ':id', $id, PDO::PARAM_INT, 2);
			$requeteSuppression2->execute();
			
            echo "Stagiaire supprimé avec succès !";

            // Redirection
            header('Location: index.php?suppression=1');
        }
        catch (PDOException $e) {
        	echo "Erreur : " . $e->getMessage() . "<br/>";
        	die();
        }
    }
    else {
        header('Location: suppression-stagiaire.php?erreur=1');
    }
    
?>