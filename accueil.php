<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>accueil</title>
	</head>
	<body>
		<h1>Page d'accueil</h1>
		<h2>Recherche:</h2>
		<form action="resultatrecherche.php" method="get">
    	<input type="search" name="recherche">
			<input type="submit" value="chercher">
		<br>
		<h2>compte</h2>
		<a href="connexion.php">connectez-vous</a>
		<br>
		<a href="inscription.html">inscrivez-vous</a>
		<br>
		<a href="profil.php">consultez votre profil ici</a>
</form>
	</body>
</html>
