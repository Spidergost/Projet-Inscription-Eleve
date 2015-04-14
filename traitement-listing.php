<?php

    // Enregistrement des variables à partir du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nationalite = $_POST['nationalite'];
    $formation = $_POST['formation'];
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$option = $_POST['option'];
	$envoi = $_POST['envoi'];
	
	
	
	if ($envoi == 'yes') {
		$id_formateur = implode(', ',$option);
		echo '<p>options:<br><br>'.$id_formateur.'</p>';
    }

	if ( ($nom!='') && ($prenom!='') && ($nationalite!='') && ($formation!='') && ($id_formateur!='') /*&& ($id_salle!='')*/ && ($date_debut!='') && ($date_fin!='') ) {

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
			// requête SQL préparé
			$requeteInsertion2 = $db->prepare('INSERT INTO STAGIAIRE_FORMATEUR (ID, ID_FORMATEUR, DATE_DEBUT, DATE_FIN)
				VALUES (:id, :id_formateur, :date_debut, :date_fin)');
            // On remplie les paramètres
            $requeteInsertion->bindParam(':id', $id, PDO::PARAM_INT, 2);
			$requeteInsertion2->bindParam(':id', $id, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':prenom', $prenom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':nationalite', $nationalite, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':formation', $formation, PDO::PARAM_INT, 2);
			$requeteInsertion2->bindParam(':id_formateur', $id_formateur, PDO::PARAM_STR, 20);
			$requeteInsertion2->bindParam(':date_debut', $date_debut, PDO::PARAM_STR, 20);
			$requeteInsertion2->bindParam(':date_fin', $date_fin, PDO::PARAM_STR, 20);

            // On l'éxecute
            $requeteInsertion->execute();
			$requeteInsertion2->execute();
            echo "Stagiaire ajouté avec succès !";

            
        }
        catch (PDOException $e) {
        	echo "Erreur : " . $e->getMessage() . "<br/>";
        	die();
        }
		// Redirection
            header('Location: listing.php?listing=1');
    }
    else {
        header('Location: listing.php?erreur=1');
    }
    
?>