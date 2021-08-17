<?php
    //création d'une session
    session_start();
    //création d'une variable $_SESSION['name'] 
    $_SESSION['name'] = "toto";
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test session start</title>
</head>
<body>
    <?php
        //affichage du contenu de $_SESSION['name']
        echo $_SESSION['name'];
        echo '</br>';
        //test si $_SESSION['trs1'] pour vérifier si on est allé sur la page session_transfert1.php
        if(isset($_SESSION['trs1'])){
            echo $_SESSION['trs1'];
            echo '</br>';
        }
        //test si $_SESSION['trs1'] pour vérifier si on est allé sur la page session_transfert1.php
        if(isset($_SESSION['trs2'])){
                    echo $_SESSION['trs2'];
                    echo '</br>';
        }
    ?>
    <a href="session_transfert1.php">lien transfert 1</a>
    <br>
    <a href="session_deconnect.php">deconnexion</a>
</body>
</html>