<?php

/* Connexion à la BDD avec PDO*/
/* PDO crée l'interface permettant de se connecter à la BDD et permet une plus large compatibilité que mysqli*/
try{
    /* On définit tous les paramètres dont on va avoir besoin */
    $serverName = "localhost";
    $dbName = "connexion";
    $username = "root";
    $password = "";
    $options = array(
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC /* FETCH_ASSOC permet de retourner le résultat sous forme de tableau associatif. (clé = nom de colonne) */
    );

    /* On crée notre connexion en passant nos variables précedemment déclaré en paramètre */
    $connection = new PDO("mysql:host=$serverName; dbname=$dbName", $username, $password, $options);
}

/* Si la connexion échoue, on attrape l'exception */
catch(Exception $e){
    echo $e->getMessage();
}

?>