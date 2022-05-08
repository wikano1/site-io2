<?php
	include("connexionmysql.php");
	$conn = connexion();
	session_start();

	//vérification de si l'utilisateur est un administrateur ou non -> oui=<p>, non=/
	if (isset($_SESSION['nom'])) {
		$user = $_SESSION['nom'];
		$verif = mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$user'");
		$verif = mysqli_fetch_array($verif);
	}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>accueil</title>
  <link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <nav> <!-- barre de navigation-->
      <div class="onglets">
        <a href="accueil.php?page=1">Accueil</a>
        <a>
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
        </a>
      </div>
      <div class="buttons">
        <?php
	    	//vérification de si l'utilisateur est connecté ou non -> oui=deconnexion.php, non=connexion.php
		    if (isset($_SESSION['nom'])) {
				$_SESSION['val']=1;
		    ?>
		    <button class="deconnexion"><a href="deconnexion.php">deconnectez-vous</a> </button>
		    <?php } else { ?>

        <button class="login"><a href="connexion.php">connectez-vous</a></button>
		    <?php } ?>
		    <button class="login"><a href="inscription1.php">inscrivez-vous</a></button>

		    <button class="login"><a href="profil.php">consultez votre profil ici</a></button>
        </form>
      </div>
    </nav> <!-- fin de la barre de navigation -->

          <br><br>

        <?php
        if (isset($verif['0'])) { ?>
		      <p>vous êtes administrateur, cliquez <a href="pageadmin.php">ici</a> pour accéder à l'espace administrateur</p>
		    <?php }
        ?>



<footer> <!-- le footer en bas de page -->
  <div class ="colonnes">
    <div class="colonne">
      <p>a propos</p>
    </div>
    <div class="colonne">
      <p>nos reseaux sociaux</p>
    </div>
    <div class="colonne">
      <p>aide</p>
     </div>
    <div class="colonne">
      <p>conditions d'utilistations</p>
    </div>
  </div>
</footer>

</body>
</html>
