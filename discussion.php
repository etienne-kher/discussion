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
            $connexion = mysqli_connect("localhost", "root", "", "discussion");
            $requete = "SELECT utilisateurs.login, messages.message, messages.date FROM utilisateurs, messages WHERE messages.id_utilisateur = utilisateurs.id ORDER BY date DESC";
            $query = mysqli_query($connexion, $requete);
            $resultat = mysqli_fetch_all($query);
            foreach($resultat as list($a, $b, $c))
            {
                echo "<b>Posté le ".$c." par ".$a."<i>".$b."</i></b><br/>";
            }
        ?>
		<?php
        if (isset($_SESSION['login'])) 
            {
               ?> 
                <form action="discussion.php" method="post" class="formuser">
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
                $requete = "INSERT INTO messages (message,id_utilisateur,date) VALUE (\"$message\",$logid,NOW())";
                $query = mysqli_query($connexion, $requete);
            }
        ?>
</main>
<?php include('footer.php'); ?>
</body>
</html>