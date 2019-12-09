<?php 
session_start(); 
include('function.php');
if(isset($_POST['sal']))
{
	$req="INSERT INTO `salon` (`id`, `nom`, `date`, `texte`, `auteur`) VALUES (NULL, '".$_POST['nom']."', CURRENT_DATE,'".$_POST['question']."', '".$_SESSION['login']."');";
	sql($req);	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Salon</title>
	<link rel="stylesheet" type="text/css" href="discussion.css">
</head>
<body>
<?php include('header.php'); ?>
<main>
	<?php 
		if (isset($_SESSION['login'])) {
	?>
	<form id="form-sal" action="salon.php" method="post">
		<label>Nom du sujet</label><input type="text" name="nom">
		<label>Votre question</label><textarea type="text" name="question"></textarea>
		<input type="submit" name="sal">
	</form>
<?php 
}else{
?>
<p>vous devez être connecté pour ouvrir une discussion</p>
<?php
}
$req="SELECT * FROM salon";
$salon=sql($req);
foreach($salon as $s)
            {?>
        <div class="div-sal">
        	<h1><?php echo $s[1]; ?></h1> 
            <div>
            	<article>
            		<p>par <?php echo $s[4]; ?></p>
            		<p>le <?php echo $s[2]; ?></p>
               </article>
               <section>
               	<?php echo $s[3]; ?><br>
               </section>
			</div>
			<a href="discussion.php?id=<?php echo $s[0]; ?>">consulter</a>
		</div>	
           <?php }

?>
</main>
<?php include('footer.php'); ?>
</body>
</html>