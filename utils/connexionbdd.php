<?php   
    //connexion à la base de données
    //(à modifier en fonction de votre base de données dans mon cas la bdd l'appele task1)
    $bdd = new PDO('mysql:host=localhost;dbname=task1', 'root','', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>