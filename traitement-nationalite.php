<?php

    // Enregistrement des variables à partir du formulaire
    $nationalite = $_POST['nationalite'];

	if ($nationalite!='') {

    	try {
            // Connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion à la base réussi. <br/>";
			
           // On calcul l'Id à mettre à la nouvelle nationalité (l'id max précédent + 1)
            $requeteIdNationalite = $db->query('SELECT MAX(ID_NATIONALITE)FROM NATIONALITE');
            $valeurId = $requeteIdNationalite->fetch();
            $id = $valeurId['MAX(ID_NATIONALITE)'];
            $id++;
   
            // Requête SQL préparé
            $requeteNationalite = $db->prepare('INSERT INTO NATIONALITE (ID_NATIONALITE, LIBELLE)  VALUES (:id, :nationalite)');
            // On remplie les paramètres
            $requeteNationalite->bindParam(':id', $id, PDO::PARAM_INT, 2);
			$requeteNationalite->bindParam(':nationalite', $nationalite, PDO::PARAM_STR, 20);
            // On l'éxecute
            $requeteNationalite->execute();
			
			echo "Nationalité ajoutée avec succès !";

            // Redirection
            header('Location: insertion-stagiaire.php?nationalite=1');
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