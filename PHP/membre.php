<?php session_start();
if (isset($_SESSION['email'])) {
    try {
        $conn = new PDO("pgsql:host=localhost;port=5432;dbname=killian.colla@etu.univ-cotedazur.fr", "ck901420", "21901420");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connexion echoué";
    }

    $sql = $conn->prepare('SELECT firstname, username, lastname, gender, phone, dateofbirth, address, email, recoveryemail, password, avatar FROM member WHERE email = ?');
    $sql->execute(array($_SESSION['email']));
    $resultat = $sql->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Member page</title>
        <link rel="stylesheet" href="css/membre.css" />
        <link rel="stylesheet" href="css/media.css">
        <link rel="stylesheet" href="css/reset.css">
        <link href="https://unpkg.com/tailwindcss@%5E1.0/dist/base.min.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="nav">
            <a href="accueil.html">Ocean Network</a>
            <a href="#Friends">Friends</a>
            <a href=".">Profile</a>
         </nav>
        <main class="main--container">
            <nav class="nav--button--header"><a class="a-button-head" href="">Edit profile</a></nav>
            <div class="profile--box">
            <div class="img--box">
                <div class="enligne"></div>
                    <img class="avatar-profile" src=<?php echo "images/avatar/" . $_SESSION['email'] . ".jpeg"; ?> alt=$resultat[username] height="150px" width="150px">
                </div>
                <div>
                    <h1>Firstname</h1>
                    <h2>Name</h2>
                    <h3>Status</h3>
                </div>
            </div>
            <div class="ligne1"></div>
            <div class="content--info--user">
                <div class="name--info">
                <h3>firstname</h3>
                <h3>lastname</h3>
                <h3>username</h3>
                <h3>gender</h3>
                <h3>Phone</h3>
                <h3>dateofbirth</h3>
                <h3>address</h3>
                <h3>email</h3>
                <h3>recoveryemail</h3>
            </div>
            <?php
            echo <<< EOS
                <div class="info--user">
                <h3>$resultat[firstname]</h3>
                <h3>$resultat[lastname]</h3>
                <h3>$resultat[username]</h3>
                <h3>$resultat[gender]</h3>
                <h3>$resultat[phone]</h3>
                <h3>$resultat[dateofbirth]</h3>
                <h3>$resultat[address]</h3>
                <h3>$resultat[email]</h3>
                <h3>$resultat[recoveryemail]</h3>
                </div>
            EOS;
            ?>
            </div>
        </main>
    </body>
<?php
} else {
header('Location: index.php');
}
?>
    </body>
</html>
