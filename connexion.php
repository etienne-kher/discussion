<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
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
			<form action="connexion.php" method="post">
			<label>Login</label>
			<input name="login" type="text" placeholder="votre login" required>
			<label>Password</label>
			<input name="mdp" type="password" required>
			<input type="submit" class="mybutton" value="log in">
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
						<p>une erreur dans le login ou le mot de passe c'est produite</p>
					<?php
						}
				}
			
		}
	?>
</main>
<?php include('footer.php'); ?>
</body>
</html>