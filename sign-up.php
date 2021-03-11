<?php

require_once("MyError.php");
require_once("template/header.php");

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/login-form.css">
</head>
<body>
    
    <form action="add-user.php" method="POST">
        <h1>Inscription</h1>

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
                <span><i class="fas fa-eye" aria-hidden="true"></i></span>
            </p>
            <p class="pwd">
                <label for="password">CONFIRMEZ VOTRE MOT DE PASSE</label>
                <input type="password" name="verifpassword" id="verifpassword" required>
                <span><i class="fas fa-eye" aria-hidden="true"></i></span>
            </p>
            <p>
                <input type="hidden" name="token">
            </p>
            <p>
                <input type="submit" value="S'inscrire" id="sign-up">
            </p>
        </div>
    </form>

        <script src="js/main.js"></script>
</body>
</html>