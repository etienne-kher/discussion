<?php 
session_start(); 
include('function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Discussion</title>
</head>
<body>
<?php include('header.php'); ?>
<main>
<?php
    if(isset($_GET['id'])&&is_numeric($_GET['id']))
    { 
    $requete="SELECT COUNT(*) FROM `salon` WHERE id=".$_GET['id'].";";
    $res=sql($requete);
        if ($res[0][0]!=0) {
        
    
            $sal=$_GET['id'];
            $connexion = mysqli_connect("localhost", "root", "", "discussion");
            $requete = "SELECT utilisateurs.login, messages.message, date_format(messages.date,\"%T le %e %c %Y\")  FROM utilisateurs, messages WHERE messages.id_utilisateur = utilisateurs.id AND messages.id_salon=$sal ORDER BY date ";
            $query = mysqli_query($connexion, $requete);
            $resultat = mysqli_fetch_all($query);
            foreach($resultat as list($a, $b, $c))
            {
                echo "<b>".$a."</b> à ".$c.": <i>".$b."</i></b><br/>";
            }
        ?>
		<?php
        if (isset($_SESSION['login'])) 
            {
               ?> 
                <form action="discussion.php?id=<?php echo $_GET['id']; ?>" method="post" class="formuser">
                <label>Message</label>
                <input type="text" name="message" required>
                <input class="mybutton"  type="submit" value="Poster" name="poster">
                </form>
                <?php
            }
        else
            {
                echo "Veuillez vous connecter pour avoir accés à cette page";
            }
            if(isset($_POST["poster"]))
            {
                $log = $_SESSION['login'];
                $message = $_POST["message"];
                $connexion = mysqli_connect("localhost", "root", "", "discussion");
                $requetelog = "SELECT id FROM utilisateurs WHERE login = '$log'";
                $querylog = mysqli_query($connexion, $requetelog);
                $resultatlog = mysqli_fetch_assoc($querylog);
                $logid = $resultatlog["id"];
                
                $requete = "INSERT INTO messages (message,id_utilisateur,date,id_salon) VALUE (\"$message\",$logid,NOW(),$sal)";
                $query = mysqli_query($connexion, $requete);
                header("Location:discussion.php?id=$sal");
            }
    }
    else
{
       echo "404";
}  
}
else
{
       echo "404";
}       
        ?>
</main>
<?php include('footer.php'); ?>
</body>
</html>