<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Page d'inscription</title>
        <link rel="stylesheet" href="css/inscription.css" />
        <link rel="stylesheet" href="css/media.css">
        <link rel="stylesheet" href="css/reset.css">
    </head>
    <body>
        <form action="checkInscriptionValues.php" name="formulaire" method="POST" enctype="multipart/form-data">
            <div class="container">
                <center>
                    <h1 id="main_title"> OceanNetwork Registeration Form </h1>
                </center>
                <hr>
                <label> Firstname </label>
                <input type="text" name="firstname" placeholder="Firstname" size="15" required />
                <label> Username </label>
                <input type="text" name="username" placeholder="Username" size="15" required />
                <label> Lastname </label>
                <input type="text" name="lastname" placeholder="Lastname" size="15" required />
                <div>
                    <label> Gender</label><br>
                    <input type="radio" value="Male" name="gender" checked> Male
                    <input type="radio" value="Female" name="gender"> Female
                    <input type="radio" value="Other" name="gender"> Other
                </div>
                <label>Phone :</label>
                <input type="text" name="phonenumber" placeholder="Country Code" value="+33" size="2" required />
                <label>Date of birth :</label>
                <input type="date" name="dob" required />
                <label for="currentaddress">Current Address :</label></br>
                <textarea size="20" name="address" placeholder="Current Address" value="address" required></textarea>
                <label for="email">Email</label>
                <input type="text" placeholder="Enter Email" name="email" required>
                <label for="email">Recovery email</label>
                <input type="text" placeholder="Enter Email" name="recovery_email" required>
                <label for="pws">Password</label>
                <input type="password" placeholder="Enter Password" name="pwd" required>
                <label for="pwd-repeat">Confirm Password</label>
                <input type="password" placeholder="Enter Password" name="pwd-repeat" required>
                <label for="pwd">Avatar</label></br>
                <input type="file" name="photo" accept="image/jpg, image/jpeg" required></br></br>
                <button type="submit" name="submit" class="registerbtn">Register</button>
            </div>
        </form>
    </body>
</html>
