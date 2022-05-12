<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page de connexion</title>
    <link rel="stylesheet" href="css/connexion.css" />
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/reset.css">

</head>
<body>

    <?php
    try {
        $conn = new PDO("pgsql:host=localhost;port=5432;dbname=killian.colla@etu.univ-cotedazur.fr", "ck901420", "21901420");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connexion echoué";
    }
    if (!isset($_SESSION['email'])) {
    ?>

        <main class="main_page">
            <div class="title_page">
                <h1>OceanNetwork</h1>
            </div>
            <div class="background_main">
                <p class="login_from_p">Login form</p>
                <div class="main_connecting">
                    <form action="" class="main_form" method="post">
                        <p class="p_email">Email</p>
                        <input type="text" placeholder="Enter email" class="username" name="email" required />
                        <p class="p_mdp">Password</p>
                        <input type="password" name="password" id="password" min-length="6" placeholder="Enter password" required />
                        <nav>
                            <a class="forgot_a" href="#">forgot password ?</a>
                        </nav>
                        <button id="login" name="submit">LOGIN</button>
                        <div>
                            <p class="signup_p_foot">
                                Not a member ?<a href="inscription.php">signup now !</a>
                            </p>
                        </div>
                    </form>

                <?php
                if (isset($_POST['submit'])) {
                    $sql = $conn->prepare('SELECT email, password FROM member WHERE email = ?');
                    $sql->execute(array($_POST['email']));
                    $resultat = $sql->fetch();

                    if (!$resultat) {
                        echo 'Mauvais identifiant ou mot de passe !';
                    } else {
                        if ($_POST['password'] == $resultat['password']) {
                            $_SESSION['email'] = $resultat['email'];
                            header('Location: pageaccueil.php');
                        } else {
                            echo 'Mauvais identifiant ou mot de passe !';
                        }
                    }
                }
                
            } else header('Location: pageaccueil.php');
            
            // Fermeture :
            $conn = null;?>
            
                </div>
            </div>
        </main>
</body>
</html>
