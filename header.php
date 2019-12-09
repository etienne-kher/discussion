<?php
	if(isset($_GET['deconnexion']))
	{
		session_destroy();
		header("location:index.php");
	}
?>
<header>
			<nav>
				<a href="index.php">Accueil</a>
				<?php 
					if(!isset($_SESSION['login']))
					{
						echo "
								<a href=\"inscription.php\">Inscription</a>
								<a href=\"connexion.php\">Connexion</a>
							";
					}else
					{
						echo"
								<a href=\"index.php?deconnexion=deco\">Deconnexion</a>
								<a href=\"profil.php\">Profil</a>
							";
					}
				?>
				<a href="salon.php">Salon</a>
			</nav>
</header>