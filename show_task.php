<?php
    /*-----------------------------------------------------
                            Controler :
    -----------------------------------------------------*/
   
    /*-----------------------------------------------------
                            Session :
    -----------------------------------------------------*/
     //création de la session
     session_start();  
    /*-----------------------------------------------------
                        Imports :
    -----------------------------------------------------*/ 
    //import models
    include('./model/user.php');
    include('./model/task.php');
    //import de la connexion à la bdd
    include('./utils/connexionbdd.php');    
    //import du menu
    include('view/menu.php');
    //import de la vue connexion
    include('view/view_all_task.php');
    /*-----------------------------------------------------
                            Vue :
    -----------------------------------------------------*/    
    echo '<form action="" method="post">';
    echo '<table>';
    //nouvel objet task
    $task = new Task();
    //appel de la méthode showAllTask($bdd) qui retourne toutes les tâches
    $task->showAllTask($bdd);    
    echo '</table><br>';
    echo '<p><input type="submit" value="terminer tâche" /></p>';
    echo '</form>';
    //récupération de la tâche mise à jour
    if(isset($_GET['update_task']) AND isset($_GET['idtask']))
    {
        //affichage de la tâche mise à jour
        echo '<p> La tâche N° '.$_GET['idtask'].' a été mise à jour </p>';
    }
    //popup modal
    echo '<div id="dialog"></div>';
    /*-----------------------------------------------------
                            Tests :
    -----------------------------------------------------*/
    //test id_task
    if (isset($_POST['id_task']))
    {   
        // boucle pour chaque tâches cochées
        foreach($_POST['id_task'] as $value)
        {   
            //éxécution de la méthode validateTask qui permet de terminer une tâche
            $task->validateTask($bdd, $value);            
        }
    }
    //test des valeurs en GET dans l'url pour mettre à jour la tâche
    if(isset($_GET['name_task']) AND isset($_GET['content_task']) AND isset($_GET['date_task']) 
    AND isset($_GET['id_cat']) AND isset($_GET['id_task']))
    {
        //Création des variables
        $idTask = $_GET['id_task'];
        $nameTask = $_GET['name_task'];
        $contentTask = $_GET['content_task'];
        $dateTask = $_GET['date_task'];
        $idCat = $_GET['id_cat'];
        $validateTask = 0;
        $idUserTask = $_SESSION['idUser'];
        //nouvel objet task
        $task1 = new Task();
        //affectation des valeurs à l'objet $task1
        $task1->setIdTask($idTask);
        $task1->setNameTask($nameTask);
        $task1->setContentTask($contentTask);
        $task1->setDateTask($dateTask);
        $task1->setIdCat($idCat);
        $task1->setValidateTask($validateTask);
        $task1->setIdUserTask($idUserTask);
        
        //appel de la méthode updateTask pour mettre à jour une tâche depuis le modal
        $task1->updatetask($bdd);        
    }
?>  
