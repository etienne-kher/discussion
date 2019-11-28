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
			<input name="login" type="text" required>
			<label>Password</label>
			<input name="mdp" type="password" required>
			<input type="submit" class="mybutton" value="log in">
			</form><?php
		}
		if(isset($_POST["login"]) && isset($_POST["mdp"]))
		{
			$connexion = mysqli_connect("localhost", "root", "", "discussion");
			$requete = "SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."';";
			var_dump($requete);
			$query = mysqli_query($connexion, $requete);
			$resultat = mysqli_fetch_array($query);
			if(!empty($resultat))
			{
				if(chiffre($_POST["mdp"])==$resultat["password"])
				{
					$_SESSION["login"] = $_POST["login"];
					header("location:index.php");
				}
				else
				{
					?><p>Votre password n'est pas bon</p>
					
					<form action="connexion.php" method="post">
					<label>Login</label>
					<input name="login" type="text" required>
					<label>Password</label>
					<input name="mdp" type="password" required>
					<input type="submit" class="mybutton" value="log in">
					</form>
					<?php
				}
			}
			else
			{
				?><p>Votre nom d'utilisateur n'éxiste pas</p>
				
				<form action="connexion.php" method="post">
				<label>Login</label>
				<input name="login" type="text" required>
				<label>Password</label>
				<input name="mdp" type="password" required>
				<input type="submit" class="mybutton" value="log in">
				</form>
				<?php
			}
			mysqli_close($connexion);
		}
	?>
</main>
<?php include('footer.php'); ?>
</body>
</html>