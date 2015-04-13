<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/index.css" media="screen" />
        <title>Accueil</title>
    </head>

    <body>

		<div class="titre">
			<a > <h1> Accueil </h1> </a>
		</div>

		<div class="liens">

			<div class="page_1" >
				<a href="insertion-stagiaire.php" style="display:block;"> Insérer un stagiaire </a>
			</div>

			<div class="page_2">
				<a href="affichage-stagiaires.php" style="display:block;"> Afficher les stagiaires </a>
			</div>

			<div class="page_3">
				<a href="suppression-stagiaire.php" style="display:block;"> Supprimer un stagiaire </a>
			</div>

			<div class="page_4">
				<a href="modification-stagiaire.php" style="display:block;"> Modifier les informations d'un stagiaire </a>
			</div>

			<div class="page_5">
				<a href="listing.php" style="display:block;"> Liste des formations, leurs formateurs, <br/> leurs salles avec les dates </a>
			</div>

			<div class="page_6">
				<a href="insertion-stagiaire.php" style="display:block;"> Page 6 </a>
			</div>

		</div>

		<?php
			// Lancement script JS de confirmation pour l'insertion de stagiaire.
			if (isset($_GET['insertion'])) {
				if ($_GET['insertion']==1) {
					echo "<script>alert('Insertion de stagiaire réussi !')</script>";
				}
			}
			else if (isset($_GET['suppression'])) {
				if ($_GET['suppression']==1) {
					echo "<script>alert('Suppression du stagiaire réussi !')</script>";
				}
			}
		?>

    </body>
</html>
