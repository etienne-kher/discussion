<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier Profil</title>
</head>
<body>
<?php include('header.php'); ?>
<main>
<section class="leftsidebar">

<?php

if (isset($_SESSION['login'])) 
{
    $connexion = mysqli_connect("localhost", "root", "", "discussion");
    $requete = "SELECT * FROM utilisateurs WHERE login='" . $_SESSION['login'] . "'";
    $query = mysqli_query($connexion, $requete);
    $resultat = mysqli_fetch_assoc($query);

    ?>

    <form class="formuser" action="profil.php" method="post">
        <label> Login </label>
        <input type="text" name="login" value=<?php echo $resultat['login']; ?> />
        <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
        <input class="mybutton" type="submit" name="modifier" value="Modifier" />
    </form>

    <?php 
        if (isset($_POST['modifier']) ) 
        {
             $login = $_POST["login"];
             $prenom = $_POST["prenom"];
             $nom = $_POST["nom"];
             $requete2 = "SELECT login FROM utilisateurs WHERE login = '$login'";
             $query2 = mysqli_query($connexion, $requete2);
             $resultat2 = mysqli_fetch_all($query2);
             if(!empty($resultat2))
                {
                   echo "Login deja utilisé, requete refusé.<br>";
                }
            if(empty($resultat2))
                {
                    $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "' WHERE id = '" . $resultat['id'] . "'";
                    $querylog = mysqli_query($connexion, $updatelog);
                    $_SESSION['login']=$_POST['login'];
                    header("Location:profil.php");
                }
        }

    ?>
</section>

<section class="rightsidebar"> 
     <form class="formuser" action="profil.php" method="post">
        <label> New Password </label>
        <input type="password" name="passwordx" />
        <label> Confirm New Password </label>
        <input type="password" name="passwordconf" />
        <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
        <input class="mybutton" type="submit" name="modifier2" value="Modifier MDP" />
    </form>

<?php 
    if (isset($_POST['modifier2'])) 
        {
           if ($_POST["passwordx"] != $_POST["passwordconf"]) 
              {
                echo "Attention ! Mot de passe différents";
              } 
           elseif(isset($_POST['passwordx'])){
                $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                $query2 = mysqli_query($connexion, $updatepwd);
                header('Location:profil.php');
              }
        }
?>
</section>

<?php

} 
else 
{
echo "Veuillez vous connecter pour accéder à votre page !";
}

?>
</main>
<?php include('footer.php'); ?>
</body>
</html>