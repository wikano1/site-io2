<?php
	include("connexionmysql.php");
	$conn = connexion();
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
			<select name="opérande">
				<option value="=">=</option>
				<option value=">=">></option>
				<option value="<="><</option>
			</select>
			<select name="note/5">
				<option value="/">/</option>
    		<option value="1">1/5</option>
    		<option value="2">2/5</option>
    		<option value="3">3/5</option>
    		<option value="4">4/5</option>
    		<option value="5">5/5</option>
    	</select>
			<input type="submit" value="chercher">
		</form>
		<br>
		<h2>compte</h2>
		<?php
		//vérification de si l'utilisateur est un connecté ou non -> oui=deconnexion.php, non=connexion.php
		if (isset($_SESSION['nom'])) {
				$_SESSION['val']=1;
		?>
		<a href="deconnexion.php">deconnectez-vous</a><br>
		<?php } else { ?>
		<a href="connexion.php">connectez-vous</a><br>
		<?php } ?>
		<a href="inscription.html">inscrivez-vous</a>
		<br>
		<a href="profil.php">consultez votre profil ici</a>
		<?php
		//vérification de si l'utilisateur est un administrateur ou non -> oui=<p>, non=/
			$user = $_SESSION['nom'];
			$a = mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$user'");
			$a = mysqli_fetch_array($a);
			if (isset($a['0'])) { ?>
		<p>vous etes administrateur, cliquez <a href="pageadmin.php">ici</a> pour accéder à l'espace administrateur</p>
		<?php } ?>
	</body>
</html>
