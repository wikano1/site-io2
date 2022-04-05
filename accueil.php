<?php
	include("connexionmysql.php");
	$conn = connexion();
	session_start();
	function lien() {
		$_SESSION['bool'] = 1;
		return "deconnexion.php";
	}
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
			if (isset($_SESSION['nom'])) {
				echo "<form id=\"deconnexion\" action=\"deconnexion.php\" method=\"post\">
					<input type=\"hidden\" name=\"val\" value=\"1\">
					<a href=\"".lien()."\">deconnectez-vous</a><br>
				</form>";
			} else {
				echo "<a href=\"connexion.php\">connectez-vous</a><br>";
			}
		?>
		<a href="inscription.html">inscrivez-vous</a>
		<br>
		<a href="profil.php">consultez votre profil ici</a>
		<?php
			$user = $_SESSION['nom'];
			$a = mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$user'");
			$a = mysqli_fetch_array($a);
			if (isset($a['0'])) {
				echo "<p>vous etes administrateur, cliquez <a href=\"pageadmin.php\">ici</a> pour accéder à l'espace administrateur</p>";
			}
		?>
	</body>
</html>
