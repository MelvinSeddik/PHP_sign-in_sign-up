<?php

require_once("connect.php");
require_once("Controller.php");
require_once("MyError.php");

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }



$controller = new Controller($connection);

/* On filtre les input avec filter_input pour nous prévenir de la faille XSS */
/* FILTER_SANITIZE_STRING va enlever les tags HTML */
/* FILTER FLAG STRIP LOW va enlever tous les caractères ASCII qui ont une valeur numérique inférieure à 32 */
/* FILTER FLAG STRIP HIGH va enlever tous les caractères ASCII qui ont une valeur numérique supérieure à 127 */
$name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

if(is_string($name))
{  
    $pwd = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    $token = filter_input(INPUT_POST, 'token', FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => '#^[A-Fa-f0-9]{48}$#'
        ]
    ]);

    
    $user = $controller->getUser($name);

    if(is_array($user))
    {
        if($controller->verifyPassword($pwd))
        {
            if(hash_equals($_SESSION["token"], $token))
            {
                $_SESSION["user"] = $user;
                header("Location:index.php");
            }

            else
            {
                $_SESSION['error']->setError(-8, "Identification incorrecte, veuillez réessayer");
                header("Location:login-form.php?error");
            }
        }

        else
        {
            $_SESSION["error"]->setError(-7, "Identification incorrecte, veuillez réessayer");
            header("Location:login-form.php?error");
        }
    }

    else
    {
        $_SESSION["error"]->setError(-6, "Identification incorrecte, veuillez réessayer");
        header("Location:login-form.php?error");
    }
}

else
{
    $_SESSION['error']->setError(-5, "Identification incorrecte ! Veuillez réessayer...") ;
    header("Location:login-form.php?error");
}