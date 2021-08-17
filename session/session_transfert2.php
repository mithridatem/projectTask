<?php
    //création d'une session
    session_start();
    //affichage de la variable $_SESSION['name']
    echo $_SESSION['name'];
    echo '</br>';
    //création de la super globale $_SESSION['trs1']
    $_SESSION['trs2'] = "transfert2";
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test session transfert 21</title>
</head>
<body>
    <a href="session_connect.php">retour session connect</a>
    <br>
    <a href="session_transfert1.php">retour vers session transfert 1</a>
    <br>
    <a href="session_deconnect.php">deconnexion</a>
</body>
</html>