<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/indexV2.css" media="screen" />
        <title>Accueil</title>
    </head>

    <body>

		<div class="titre">
			<a > <h1> Accueil </h1> </a>
		</div>

		<div class="liens">

            <a href="insertion-stagiaire.php" >
			<div class="page" >
				<span style="display:block;"> Insérer un stagiaire </span>
			</div>
			</a>
            <a href="affichage-stagiaires.php" >
			<div class="page">
				 <span style="display:block;">Afficher les stagiaires</span>
			</div>
            </a>
            <a href="suppression-stagiaire.php">
			<div class="page">
				<span style="display:block;"> Supprimer un stagiaire </span>
			</div>
            </a>
            <a href="modification-stagiaire.php">
			<div class="page">
				<span style="display:block;"> Modifier les informations d'un stagiaire </span>
			</div>
            </a>
            <a href="listing.php" >
			<div class="page">
				<span style="display:block;"> Liste des formations, leurs formateurs, <br/> leurs salles avec les dates </span>
			</div>
            </a>
            <a href="assemblage.php" >
			<div class="page">
				<span style="display:block;"> Assemblage </span>
			</div>
            </a>
		</div>
		
		<?php
			if (isset($_GET['suppression'])) {
				if ($_GET['suppression']==1) {
					echo "<script>alert('Suppression du stagiaire réussi !')</script>";
				}
			}
		?>

    </body>
</html>
