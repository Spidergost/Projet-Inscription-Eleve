<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/affichage-stagiaires.css" media="screen" />
    </head>

    <body>
		<div class="titre">
			<a > <h1> Suppression de Stagiaire</h1> </a>
		</div>
		<?php include('affichage-stagiaires.php'); ?>	
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
    <a href="index.php">Retour au menu</a>
    </body>
</html>