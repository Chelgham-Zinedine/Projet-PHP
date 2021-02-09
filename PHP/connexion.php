<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Page d'accueil</title>
</head>
<body>

<?php
try {
$conn = new PDO("pgsql:host=localhost;port=5432;dbname=killian.colla@etu.univ-cotedazur.fr", "ck901420", "21901420");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connexion echoué";
}
if(!isset($_SESSION['email'])){
?>
<form action="" method="post">
	Email(*) <input type="email" name="mail">
	Mot de passe(*) <input type="password" name="password">
	<input type="submit" name="envoyer" value="Valider">
</form>
<?php

    if(isset($_POST['envoyer'])){
    	$sql = $conn->prepare('SELECT email, password FROM membre WHERE email = ?');
    	$sql->execute(array($_POST['mail']));
    $resultat = $sql->fetch();

    if (!$resultat)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if ($_POST['password'] == $resultat['password']) {
            $_SESSION['email'] = $resultat['email'];
            header('Location: pageaccueil.php');
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }
    }
}
else{
    header('Location: pageaccueil.php');
}

// Fermeture :
$conn = null; 

?>

</body>
</html>