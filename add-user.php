<?php

require_once("connect.php");
require_once("Controller.php");
require_once("MyError.php");


if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

$controller = new Controller($connection);

/* On filtre les input avec filter_input pour nous prévenir de la faille XSS : */

/* Filtrage de l'username avec du regex */
$name = filter_input(INPUT_POST, "username", FILTER_VALIDATE_REGEXP, [
    "options" => [
        "regexp" => "#^[A-Za-z][A-Za-z0-9_-]{5,31}$#"
    ]
]);

if (is_string($name))
{
    /* Filtrage du password avec du regex */
    $pwd1 = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, [
        "options" => [
            /* ^*  */
            "regexp" => '#^.*(?=.{8,63})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).*$#'
        ]
    ]) ;

    if(is_string($pwd1))
    {
        /* On recherche dans la base de données si le nom existe déjà et on l'assigne à la variable $user  */
        $user = $controller->getUser($name);

        /* Si $user est de type array alors il existe déjà dans ma bdd */
        if(is_array($user))
        {
            $_SESSION["error"]->setError(-3, "Cet identifiant est déjà pris! Veuillez en choisir un autre");
            header("Location:sign-up.php?error");
        }

        
        else
        {
            /* On filtre également la confirmation du mot de passe */
            /* FILTER SANITIZE STRING supprime tous les tags HTML*/
            /* FILTER FLAG STRIP LOW va supprimer les caractères ASCII qui ont une valeur numérique inférieure à 32 */
            /* FILTER FLAG STRIP HIGH va supprimer les caractères ASCII qui ont une valeur numérique supérieure à 127 */
            $pwd2 = filter_input(INPUT_POST, "verifpassword", FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    
            /* Si les deux mots de passe sont indentiques */
            if($pwd1 === $pwd2)
            {
                /* On hash le mot de passe en argon2i et on ajoute l'utilisateur à la bdd  */
                $status = $controller->addUser(strtolower($name), password_hash($pwd1, PASSWORD_ARGON2I));
    
                /* Si l'ajout a fonctionné on redirige vers l'index */
                if($status)
                {
                    header("Location:index.php");
                }
    
                else
                {
                    $_SESSION["error"]->setError(-5, "Erreur inconnue, veuillez réessayer plus tard");
                    header("Location:sign-up.php?error");
                }
            }

            /* Si pas de correspondance entre les deux mot de passe */
            else
            {
                $_SESSION["error"]->setError(-4, "Les deux mots de passe ne correspondent pas");
                header("Location:sign-up.php?error");
            }
        }
    }

    /* Si le mot de passe ne correspond pas a la restriction du regex */
    else
    {
        $_SESSION["error"]->setError(-2, "Le mot de passe doit comporter au moins 8 caractères dont une majuscule, une minuscule et un chiffre");
        header("Location:sign-up.php?error");
    }
}

/* Si le nom d'utilisateur ne correspond pas a la restriction du regex */
else
{
    $_SESSION["error"]->setError(-1, "Le nom d'utilisateur doit comporter entre 6 et 32 caractères alphanumériques et commencer par une lettre");
    header("Location:sign-up.php?error");
}