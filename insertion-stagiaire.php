<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Insertion de stagiaire</title>
    </head>

    <body>

    	<h1>Insérer un stagiaire en formation</h1>

    	<form method="post" action="traitement-insertion.php" class="formulaire">
	    	<p>Nom :	<br /><input type="text" name="nom" /> <br /> </p>
		  	<p>Prénom : <br /><input type="text" name="prenom" /> <br /> </p>
	      	<p>
				Nationalité : 
				<select name="nationalite">
						<option selected="selected"> Français</option>
						<option> Anglais</option>
						<option> Allemand</option>
						<option> Russe</option>
			    </select>  
	      	</p>
	      
	      	<p>
				Type de la formation : 
				<select name="formation">
						<option selected="selected"> Web designer</option>
						<option> Développpeur</option>
			    </select>  
	      	</p>
	      
	      	<p>
				<input type="reset" value="Effacer" />
				<input type="submit" value="Envoyer" />
	     	</p>
    	</form>
    </body>
</html>