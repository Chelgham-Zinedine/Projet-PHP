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
?>
<form action="" method="post">
	Email(*) <input type="email" name="mail">
	Mot de passe(*) <input type="password" name="motdepasse">
	<input type="submit" name="envoyer" value="Valider">
</form>
<?php
if(isset($_POST["envoyer"])){
	$sql = $conn->prepare('INSERT INTO membre (email, password) VALUES(?, ?)');
	$sql->execute(array($_POST['mail'], $_POST['motdepasse']));
}
// Fermeture :
$conn = null; 

?>

</body>
</html>