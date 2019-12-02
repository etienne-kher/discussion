<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>
<?php include('header.php'); ?>
<main>
	<form method="post" action="Inscription">
		<label>Login : </label><input placeholder="Votre login" type="text" name="login" required>
		<label>Mot de passe : </label><input type="password" name="password" required>	
		<label>Confirmation Mot de passe : </label><input type="password" name="repassword" required>	
		<input type="submit" name="insc">		
	</form>
</main>
<?php include('footer.php');?>
</body>
</html>
<?php 
	

	if(isset($_POST['insc']))
	{
		if($_POST['password']==$_POST['repassword'])
		{
				$sql="SELECT COUNT(*) FROM utilisateurs WHERE login='".$_POST['login']."';";
				$reception = sql($sql);
				var_dump($reception);
				if($reception[0][0]==0)
				{	$_POST['password']=chiffre($_POST['password']);
					$sql="INSERT INTO `utilisateurs` (`id`,`login`,`password`) VALUES (NULL, '".$_POST['login']."','".$_POST['password']."');";
					sql($sql);
					header("location:connexion.php");
				}
				else
				{
					echo"login deja pris";
				}
		}
		else
		{
			echo"erreur mdp";
		}
	}
?>