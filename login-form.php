<?php

require_once("MyError.php");
require_once("template/header.php");

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


/* bin2hex va convertir des données binaires sous forme de chaîne de caractères hexadécimale */
/* random_bytes va générer une chaîne de charactères aléatoire avec un poids en octet correspondant à la valeur int passée en paramètre */
/* Le token sera attribué lors de l'accès à la page et nous sert à nous prémunir de la faille CSRF */
$_SESSION["token"] = bin2hex(random_bytes(24));

/* S'il n'y a pas d'erreur en session*/
/* L'erreur en session sera un nouvel objet de la classe MyError */
if(!isset($_SESSION["error"]))
{
    $_SESSION["error"] = new MyError();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/login-form.css">
</head>

<body>
    
    <form action="login.php" method="POST">
        <h1>Log in</h1>

        <?php
        if(isset($_GET["error"])){
            echo "<label class='error'>".$_SESSION["error"]."</label>";
        }

        ?>

        <div class="inset">
        <p>
            <label for="username">NOM D'UTILISATEUR</label>
            <input type="text" name="username" id="username" required>
        </p>
        <p class="pwd">
            <label for="password">MOT DE PASSE</label>
            <input type="password" name="password" id="password" required>
            <span><i class="fas fa-eye" aria-hidden="true" class="eye"></i></span>
        </p>
        <p>
            <input type="hidden" value="<?= $_SESSION["token"]?>" name="token">
        </p>
        <p class="flex acenter">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Se souvenir de moi</label>
        </p>
        </div>
        <p class="p-container">
            <span id="pw-lost">Mot de passe oublié ?</span>
            <input type="submit" name="submit" id="submit" value="Log in">
        </p>
    </form>

    <script src="js/main.js"></script>
</body>
</html>