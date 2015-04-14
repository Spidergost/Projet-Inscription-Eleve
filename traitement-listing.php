<?php

    // Enregistrement des variables � partir du formulaire
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
            // Connexion � la base de donn�es
            $db = new PDO('mysql:host=localhost;dbname=formation', 'root', '');
            // prise en charge de l'utf-8
            $db->exec("SET CHARACTER SET utf8");
            echo "Connexion � la base r�ussi. <br/>";
            
            // On calcul l'Id � mettre au nouveau stagiaire (l'id max pr�c�dent + 1)
            $requeteId = $db->query('SELECT MAX(ID) as IdMAX FROM STAGIAIRE');
            $valeurId = $requeteId->fetch();
            $id = $valeurId['IdMAX'];
            echo "La variable \$id vaut : " . $id . "<br />";
            $id++;
            echo "Elle vaut maintenant : " . $id . "<br />";

            // Requ�te SQL pr�par�
            $requeteInsertion = $db->prepare('INSERT INTO STAGIAIRE (ID, NOM, PRENOM, ID_NATIONALITE, ID_TYPE_FORMATION) 
                VALUES (:id, :nom, :prenom, :nationalite, :formation)');
			// requ�te SQL pr�par�
			$requeteInsertion2 = $db->prepare('INSERT INTO STAGIAIRE_FORMATEUR (ID, ID_FORMATEUR, DATE_DEBUT, DATE_FIN)
				VALUES (:id, :id_formateur, :date_debut, :date_fin)');
            // On remplie les param�tres
            $requeteInsertion->bindParam(':id', $id, PDO::PARAM_INT, 2);
			$requeteInsertion2->bindParam(':id', $id, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':nom', $nom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':prenom', $prenom, PDO::PARAM_STR, 20);
            $requeteInsertion->bindParam(':nationalite', $nationalite, PDO::PARAM_INT, 2);
            $requeteInsertion->bindParam(':formation', $formation, PDO::PARAM_INT, 2);
			$requeteInsertion2->bindParam(':id_formateur', $id_formateur, PDO::PARAM_STR, 20);
			$requeteInsertion2->bindParam(':date_debut', $date_debut, PDO::PARAM_STR, 20);
			$requeteInsertion2->bindParam(':date_fin', $date_fin, PDO::PARAM_STR, 20);

            // On l'�xecute
            $requeteInsertion->execute();
			$requeteInsertion2->execute();
            echo "Stagiaire ajout� avec succ�s !";

            
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