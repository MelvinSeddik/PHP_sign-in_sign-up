<?php

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
    <title>Materiel</title>
</head>
<body>
    
</body>
</html>

<?php

require_once("template/header.php");

?>

<section class="banner">
    <img src="img/13840_b.jpg" alt="intel core gen">
</section>

<section id="cat" class="flex acenter jcenter">
    <figure class="flex column"><img src="img/home-featured-cat-pc.png" alt=""><label>PC et ordinateur</label></figure>
    <figure><img src="img/home-featured-cat-composants.png" alt=""><label>Composant PC</label></figure>
    <figure><img src="img/peripheriques_0.png" alt=""><label>Périphérique PC</label></figure>
    <figure><img src="img/home-featured-cat-tel.png" alt=""><label>Image et son</label></figure>
</section>