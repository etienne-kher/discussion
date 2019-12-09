<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="discussion.css">
	<title>Connexion</title>
</head>
<body>
<?php include('header.php'); ?>
<main>
	<?php
		if(isset($_SESSION["login"]))
		{
			?><p>Vous êtes déjà connecté</p><?php
		}
		if(!isset($_SESSION["login"]))
		{
			?>
			<form action="connexion.php" method="post" class="formuser">
			<label>Login :</label>
			<input name="login" type="text" placeholder="votre login" required>
			<label>Mot de passe :</label>
			<input name="mdp" type="password" required>
			<input type="submit" class="mybutton" value="connexion">
			</form><?php
		}
		if(isset($_POST["login"]) && isset($_POST["mdp"]))
		{
			$requete = "SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."';";
			$resultat = sql($requete);
			
				if(!empty($resultat)&&chiffre($_POST["mdp"])==$resultat[0][2])
				{
					$_SESSION["login"] = $_POST["login"];
					header("location:index.php");
				}
				else
				{	if(!isset($_SESSION['login'])){
					?>
						<p id="err">une erreur dans le login ou le mot de passe s'est produite</p>
					<?php
						}
				}
			
		}
	?>
</main>
<?php include('footer.php'); ?>
</body>
</html>