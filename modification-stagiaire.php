<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modification Stagiaire</title>
    </head>

    <body>
		<div class="titre">
			<a > <h1> Modification d'un Stagiaire</h1> </a>
		</div>
		
		<h1><?php include('affichage-stagiaires.php'); ?></h1>
				
    	<form method="post" action="traitement-modification.php" class="formulaire-choix">
	    	<p>Choix du stagiaire par ID: <br /><input type="text" name="choix-id" /> <br /> </p>
	      
	      	<p>
				Type de la formation : 
				<select name="formation">
						<option selected="selected" value="1"> Web designer</option>
						<option value="2"> Développpeur</option>
			    </select>  
	      	</p>
	      
	      	<p>
				<input type="reset" value="Effacer" />
				<input type="submit" value="Envoyer" />
	     	</p>
    	</form>

    	<a href="index.php">Retour au menu</a>

    	<?php
    		// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur']==1) {
					echo "<script>alert('Veuillez remplir le formulaire en entier.')</script>";
				}
			}	
		?>
    
    </body>
</html>