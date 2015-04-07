<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<LINK href="modification-stagiaire.css" rel="stylesheet" type="text/css">
<title>Modification Stagiaire</title>
</head>
<body>
<div class="titre">
<a > <h1> Modification d'un Stagiaire</h1> </a>
</div>
<h1><?php include('affichage-stagiaires.php'); ?></h1>
<form method="post" action="traitement-insertion.php" class="formulaire">
<p>Nom : <br /><input type="text" name="nom" /> <br /> </p>
<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
<p>
Nationalité :
<select name="nationalite">
<option selected="selected" value="1"> Français</option>
<option value="2"> Anglais</option>
<option value="3"> Allemand</option>
<option value="4"> Russe</option>
</select>
</p>
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
