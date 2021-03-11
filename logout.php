<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

/* On supprime les valeurs stockées en session */
unset($_SESSION["user"]);
unset($_SESSION["error"]);

header("location:index.php");