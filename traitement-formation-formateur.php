<?php

    // Enregistrement des variables à partir du formulaire
    $formation = $_POST['formation'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$salle = $_POST['salle'];
	$debut = $_POST['debut'];
	$fin = $_POST['fin'];

	if ($nom !='' && $formation !='' && $prenom !='' && $salle !='' && $debut !='' && $fin !='') {

    	try {
            // Connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion à la base réussi. <br/>";
			
			/***1ère requête : formation ***/
			// On calcul l'Id à mettre à la nouvelle formation (l'id max précédent + 1)
            $requeteIdFormation = $db->query('SELECT MAX(ID_TYPE_FORMATION)FROM TYPE_FORMATION');
            $valeurIdA = $requeteIdFormation->fetch();
            $idA = $valeurIdA['MAX(ID_TYPE_FORMATION)'];
            $idA++;
            // Requête SQL préparé
            $requeteFormation = $db->prepare('INSERT INTO TYPE_FORMATION (ID_TYPE_FORMATION, LIBELLE)  VALUES (:idA, :formation)');
            // On remplie les paramètres
            $requeteFormation->bindParam(':idA', $idA, PDO::PARAM_INT, 2);
			$requeteFormation->bindParam(':formation', $formation, PDO::PARAM_STR, 20);
            // On l'éxecute
            $requeteFormation->execute();
			
			/***2ème requête : salle ***/
			// On calcul l'Id à mettre à la nouvelle salle (l'id max précédent + 1)
            $requeteIdSalle = $db->query('SELECT MAX(ID_SALLE)FROM SALLE');
            $valeurIdB = $requeteIdSalle->fetch();
            $idB = $valeurIdB['MAX(ID_SALLE)'];
            $idB++;
            // Requête SQL préparé
            $requeteFormateur = $db->prepare('INSERT INTO SALLE (ID_SALLE, LIBELLE)  VALUES (:idB, :salle)');
            // On remplie les paramètres
            $requeteFormation->bindParam(':idB', $idB, PDO::PARAM_INT, 2);
			$requeteFormation->bindParam(':formation', $formation, PDO::PARAM_STR, 20);
            // On l'éxecute
            $requeteFormation->execute();
			
			
			/***3ème requête : formateur ***/
			// On calcul l'Id à mettre au nouveau formateur (l'id max précédent + 1)
            $requeteIdFormateur = $db->query('SELECT MAX(ID_FORMATEUR)FROM FORMATEUR');
            $valeurIdC = $requeteIdFormateur->fetch();
            $idC = $valeurIdC['MAX(ID_FORMATEUR)'];
            $idC++;
            // Requête SQL préparé
            $requeteFormateur = $db->prepare('INSERT INTO FORMATEUR (ID_FORMATEUR, ID_SALLE, NOM, PRENOM )  VALUES (:idc, :idB, :nom, :prenom)');
            // On remplie les paramètres
            $requeteFormateur->bindParam(':idC', $idC, PDO::PARAM_INT, 2);
			$requeteFormateur->bindParam(':idB', $idB, PDO::PARAM_INT, 2);
			$requeteFormateur->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
			$requeteFormateur->bindParam(':prenom', $prenom, PDO::PARAM_STR, 20);
            // On l'éxecute
            $requeteFormateur->execute();
			
			
			/***3ème requête : formation_formateur ***/
            // Requête SQL préparé
            $requeteFormationFormateur = $db->prepare('INSERT INTO TYPE_FORMATION_FORMATEUR (ID_FORMATEUR, ID_TYPE_FORMATION, DATE_DEBUT_FORMATION, DATE_FIN_FORMATION ) VALUES (:idc, :idA, :, :debut, :fin)');
            // On remplie les paramètres
            $requeteFormationFormateur->bindParam(':idC', $idC, PDO::PARAM_INT, 2);
			$requeteFormationFormateur->bindParam(':idA', $idA, PDO::PARAM_INT, 2);
			$requeteFormationFormateur->bindParam(':debut', $debut, PDO::PARAM_STR, 20);
			$requeteFormationFormateur->bindParam(':fin', $fin, PDO::PARAM_STR, 20);
            // On l'éxecute
            $requeteFormationFormateur->execute();
			
			echo "Formation et formateur ajoutés avec succès !";

            // Redirection
            header('Location: insertion-stagiaire.php?insertion=1');
        }
        catch (PDOException $e) {
        	echo "Erreur : " . $e->getMessage() . "<br/>";
        	die();
        }
    }
    else {
        header('Location: insertion-stagiaire.php?erreur=1');
    }
    
?>