<?php

    // Enregistrement des variables à partir du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nationalite = $_POST['nationalite'];
    $formation = $_POST['formation'];

	if ( ($nom!='') && ($prenom!='') && ($nationalite!='') && ($formation!='')) {

    	try {
            // Connexion à la base de données
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion à la base réussi. <br/>";
            
            // On calcul l'Id à mettre au nouveau stagiaire (l'id max précédent + 1)
            $requeteId = $db->query('SELECT MAX(ID) as IdMAX FROM STAGIAIRE');
            $valeurId = $requeteId->fetch();
            $id = $valeurId['IdMAX'];
            echo "La variable \$id vaut : " . $id . "<br />";
            $id++;
            echo "Elle vaut maintenant : " . $id . "<br />";

            // Requête SQL préparé
            $requeteInsertion = $db->prepare('INSERT INTO STAGIAIRE (ID, NOM, PRENOM, ID_NATIONALITE, ID_TYPE_FORMATION) 
                VALUES (:id, :nom, :prenom, :nationalite, :formation)');

            // On remplie les paramètres
            $requeteInsertion->bindParam(':id', $id, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':prenom', $prenom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':nationalite', $nationalite, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':formation', $formation, PDO::PARAM_INT, 2);

            // On l'éxecute
            $requeteInsertion->execute();
            echo "Stagiaire ajouté avec succès !";

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
