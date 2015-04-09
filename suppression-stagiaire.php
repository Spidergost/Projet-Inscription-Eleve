<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Suppression Stagiaire</title>
    </head>

    <body>
		<div class="titre">
			<a > <h1> Suppression de Stagiaire</h1> </a>
		</div>
		
		<h1><?php include('affichage-stagiaires.php'); ?></h1>
				
    	<form method="post" action="traitement-suppression.php" class="formulaire">
			<p>ID :	<input type="text" name="id" /> <br /> </p>
	    	<p>
				<input type="submit" value="Supprimer le stagiaire" />
	     	</p>
    	</form>

    	<?php
    		// Lancement script JS de confirmation pour la suppression de stagiaire.
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur']==1) {
					echo "<script>alert('Veuillez selectionner un id à supprimer')</script>";
				}
			}	
		?>
    
    </body>
</html>