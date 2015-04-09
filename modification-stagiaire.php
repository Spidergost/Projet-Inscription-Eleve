<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/modification-stagiaire.css" media="screen" />
        <title>Modification d'un Stagiaire</title>
    </head>

    <body>
	
		<div class="titre">
			<a > <h1> Modification d'un Stagiaire </h1> </a>
		</div>
		<div class="affichage">
		<?php include('affichage-stagiaires.php'); ?>
		</div>	
    	<form method="post" action="traitement-modification.php" class="formulaire-choix">
		
			<div class="formulaire-modification" >
			
				<div class="choix-id" >
					<p>Choix du stagiaire par ID: <br /><input type="text" name="choix-id" /> <br /> </p>
				</div>
				
				<div class="modification-stagiaire" >
					<p>Choix des modifications: <br /> </p>
				</div>
				
					Type de la formation : 
					<select name="formation">
							<option selected="selected" value="1"> Web designer</option>
							<option value="2"> Développpeur</option>
					</select>  
				</p>
				
				Nationalité : 
				<select name="nationalite">
						<option selected="selected" value="1"> Français</option>
						<option value="2"> Anglais</option>
						<option value="3"> Allemand</option>
						<option value="4"> Russe</option>
			    </select> 
				
				<p>Nom :	<br /><input type="text" name="nom" /> <br /> </p>
				<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
			
			</div>
	      
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