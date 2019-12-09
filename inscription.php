<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="discussion.css">
	<title>Inscription</title>
</head>
<body>
<?php include('header.php'); ?>
<main>
	<form method="post" action="Inscription" class="formuser">
		<label>Login : </label><input placeholder="Votre login" type="text" name="login" required>
		<label>Mot de passe : </label><input type="password" name="password" required>	
		<label>Confirmation : </label><input type="password" name="repassword" required>	
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
				if($reception[0][0]==0)
				{	$_POST['password']=chiffre($_POST['password']);
					$sql="INSERT INTO `utilisateurs` (`id`,`login`,`password`) VALUES (NULL, '".$_POST['login']."','".$_POST['password']."');";
					sql($sql);
					header("location:connexion.php");
				}
				else
				{
					?><p id="err" >login déjà pris</p>;<?php
				}
		}
		else
		{
			?><p id="err">erreur mdp</p><?php
		}
	}
?>