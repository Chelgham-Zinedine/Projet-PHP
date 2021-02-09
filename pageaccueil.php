<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home page</title>
  <link rel="stylesheet" href="css/inscription.css" />
  <link rel="stylesheet" href="css/media.css">
  <link rel="stylesheet" href="css/reset.css">

</head>
<body>
<?php
if(isset($_SESSION['email'])){
?>
<a href="member.php"><button type="submit" name="memberpage" class="registerbtn">Member page</button></a>
<a href="deconnexion.php"><button type="submit" name="deconnexion" class="registerbtn">Log out</button></a>
<?php
}
else
{
	header('Location: index.php');
}
?>
</body>
</html>