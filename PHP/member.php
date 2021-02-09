<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Member page</title>
    <link rel="stylesheet" href="css/inscription.css" />
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/reset.css">

  </head>
<body>

<?php
if(isset($_SESSION['email'])){
	try {
	$conn = new PDO("pgsql:host=localhost;port=5432;dbname=killian.colla@etu.univ-cotedazur.fr", "ck901420", "21901420");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
  	echo "Connexion echoué";
	}

	$sql = $conn->prepare('SELECT firstname, username, lastname, gender, phone, dateofbirth, address, email, recoveryemail, password, avatar FROM member WHERE email = ?');
      $sql->execute(array($_SESSION['email']));
      $resultat = $sql->fetch();

?> 

<h2>First name : <?php echo $resultat['firstname']; ?></h2>
<h2>Last name : <?php echo $resultat['lastname']; ?></h2>
<h2>User name : <?php echo $resultat['username']; ?></h2>
<h2>Gender : <?php echo $resultat['gender']; ?></h2>
<h2>Phone number : <?php echo $resultat['phone']; ?></h2>
<h2>Date of birth : <?php echo $resultat['dateofbirth']; ?></h2>
<h2>Address : <?php echo $resultat['address']; ?></h2>
<h2>Email : <?php echo $resultat['email']; ?></h2>
<h2>Recovery email : <?php echo $resultat['recoveryemail']; ?></h2>
<img src="<?php echo "images/avatar/".$_SESSION['email'].".jpeg";?>">
</br>
<a href="pageaccueil.php"><button type="submit" name="accueil" class="registerbtn">Accueil page</button></a>

<?php

}
else{
	header('Location: index.php');
}
?>

</body>
</html>