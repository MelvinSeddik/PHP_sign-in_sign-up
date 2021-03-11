<?php

require_once("MyError.php");

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
    <title>Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="flex acenter">
        <a href="index.php" class="flex acenter">
            <figure>
                <img src="img\site-logo-white.svg" alt="logo">
            </figure>
        </a>
        
        <div class="flex acenter">
            <input type="text" name="search" placeholder="Chercher un produit, une marque, une catégorie..." class="search">
            <span><i class="fas fa-search"></i><span>
        </div>
        

        <div>

            <?php
            if(!isset($_SESSION["user"]))
            {
                echo "<a href='sign-up.php' class='btn sign-up'>Inscription</a>";
                echo "<a href='login-form.php' class='btn'>Connexion</a>";
            }

            else
            {
                echo "<a style='color:white;'>Bienvenue ".ucwords($_SESSION["user"]["username"])."</a>";
                echo "<a href='logout.php' class='btn'>Deconnexion</a>";
            }
            ?>

        </div>
    </header>

</body>

</html>