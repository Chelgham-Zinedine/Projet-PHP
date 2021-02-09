<?php

try {
$conn = new PDO("pgsql:host=localhost;port=5432;dbname=killian.colla@etu.univ-cotedazur.fr", "ck901420", "21901420");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
  echo "Connexion echoué";
}

function checkName($name){
    return preg_match("/[a-zA-Z0-9-_]*/",$name);       
}

function checkTheDate($date){
    $year = explode("-",$date)[0];
       $intyear = intval($year);
       if($intyear>1910 && $intyear <= intval(date("Y")))
            return true;
   return false;     
}

function checkNumber($number){
    return preg_match("/[0-9]*/",$number);
}

function checkAddress($address){
    return preg_match("/[a-zA-Z0-9-]*/",$address);       
}

function checkPassword($pwd){
    return preg_match("/[a-zA-Z-0-9]{8,}/",$pwd);       
}
?>

<?php

if(isset($_POST["submit"])){
    $error = "";
    //$data = $_REQUEST['formulaire'];
    $fName = trim($_POST["firstname"]);
    $uName = trim($_POST["username"]);
    $lName = trim($_POST["lastname"]);
    if(!(checkName($fName) && checkName($uName) & checkName($lName)))
        $error."First name invalid only letters, numbers, underscore and dash are allowed... \n";       
   
    $date = $_POST["dob"];
    if(!checkThedate($date))
        $error = $error."Date error \n";
    
    $gender = $_POST["gender"];

    $phoneNumb = trim($_POST["phonenumber"]);
    if(!checkNumber($phoneNumb))
        $error = $error."Phone number format incorrect \n";
    
    $address = trim($_POST["address"]);
    if(!checkAddress($address))
        $error = $error."Invalid address format \n";
    
    $email = trim($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error."Invalid email adress format \n";
    
    $recoEmail = trim($_POST["recovery_email"]);
    if (!filter_var($recoEmail, FILTER_VALIDATE_EMAIL))
        $error = $error."Invalid recovery email address format \n";

    $pwd = trim($_POST["pwd"]);
    
    if(!checkPassword($pwd))
         $error = $error."Invalid password specific character are not allowed and the minimum lenght is 8 \n";
    
    $repwd = trim($_POST["pwd-repeat"]);
    if(strcmp($pwd,$repwd)!=0)
         $error = $error."The password confirmation is not equal to the previous entered one \n";

    if(strlen($error) > 0){
        $SESSION['error'] = $error;
        header('Location: inscription.php');
        exit();
    }
    else{
      $taille = getimagesize($_FILES['photo']['tmp_name']);
      $largeur = $taille[0];
      $hauteur = $taille[1];
      $largeur_miniature = 300;
      $hauteur_miniature = $hauteur / $largeur * 300;
      $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
      $im_miniature = imagecreatetruecolor($largeur_miniature
      , $hauteur_miniature);
      imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);
      imagejpeg($im_miniature, 'images/avatar/'.$_POST['email'].'.jpeg', 90);
      $sql = $conn->prepare('INSERT INTO member (firstname, username, lastname, gender, phone, dateofbirth, address, email, recoveryemail, password, avatar) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
      $sql->execute(array($_POST['firstname'], $_POST['username'], $_POST['lastname'], $_POST['gender'], $_POST['phonenumber'], $_POST['dob'], $_POST['address'], $_POST['email'], $_POST['recovery_email'], $_POST['pwd'], $_FILES['photo']['name']));
       header('Location: index.php');
        exit();
        }
    

}

$conn = null;


?>