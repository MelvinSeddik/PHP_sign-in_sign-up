<?php

/* Création de la classe controller */
class Controller{
    private $_connection;
    private $_user;


    /* Constructeur qui définit les différentes propriétés dont la classe a besoin */
    public function __construct($connection){
        $this->_connection = $connection;
    }


    public function getUser($uname){
        try{
            /* on stock la requête SQL */
            $sql = "SELECT username, password FROM users WHERE username = LOWER(:name)";

            /* On indique la bdd dans laquelle se fera la requête, puis on prépare la requête  */
            $statement = $this->_connection->prepare($sql);

            /* On indique que le "name" de la requête est égale à la valeur de la variable passée en paramètre */
            /* Cela nous permet de nous prémunir de l'injection SQL */
            $statement->bindParam("name", $uname);

            /* On execute la requête*/
            $statement->execute();

            /* fetch va récuperer et retourner la ligne du résultat */
            $this->_user = $statement->fetch();

            return $this->_user;

        }

        /* En cas d'échec, on attrape l'exception */
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function verifyPassword($upwd){
        /* Sleep peut nous aider à nous protéger de l'attaque par force brute */
        sleep(1);
        /* password_verify vérifie que le mot de passe original correspond au mot de passe haché */
        return password_verify($upwd, $this->_user["password"]);
    }

    public function addUser($uname, $upwd){
        try{
            /* On stock la requête SQL */
            $sql = "INSERT INTO users (username, password) VALUES (:username, :pwd)";

            /* On prépare la requête */
            $statement = $this->_connection->prepare($sql);

            /* On bind l'username */
            $statement->bindParam("username", $uname);

            /* On bind le mot de passe */
            $statement->bindParam("pwd", $upwd);

            /* Et on execute! */
            return $statement->execute();
        }

        /* En cas d'échec, on choppe l'exception.. */
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}

