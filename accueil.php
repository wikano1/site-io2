<?php
	session_start();
?>
<!--token (prend la tete a tout le monde) : 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-->
<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>accueil</title>
	</head>
	<body>
		<h1>Page d'accueil</h1><p>connecté: <?php echo $SESSION_['nom'] ?></p>
		<h2>Recherche:</h2>
		<form action="resultatrecherche.php" method="get">
    	<input type="search" name="recherche">
			<input type="submit" value="chercher">
		<br>
		<h2>compte</h2>
		<a href="inscription.html">inscrivez-vous</a>
		<br>
		<a href="profil.html">consultez votre profil ici</a>
</form>
	</body>
</html>
