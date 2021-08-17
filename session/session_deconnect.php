<?php
    //ouverture de la session
    session_start();
    //suppression de la session pour se déconnecter
    session_destroy();
    //redirection vers la page session_connect.php
    header("Location: session_connect.php"); 
?>