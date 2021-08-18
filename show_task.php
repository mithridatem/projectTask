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
    echo '</table>';
    echo '<br><p><input type="submit" value="terminer tâche" /></p>';
    echo '</form>';
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
            //éxécution de la méthode validateTask
            $task->validateTask($bdd, $value);            
        }
    }
    //test des valeurs en GET dans l'url
    if(isset($_GET['name_task']) AND isset($_GET['content_task']) AND isset($_GET['date_task']) 
    AND isset($_GET['id_cat']) AND isset($_GET['id_task']))
    {
        //Création des variables
        $idtask = $_GET['id_task'];
        $nameTask = $_GET['name_task'];
        $contentTask = $_GET['content_task'];
        $dateTask = $_GET['date_task'];
        $idCat = $_GET['id_cat'];
        $validateTask = 0;
        $idUserTask = $_SESSION['idUser'];

        try
        {   
            //requête mise à jour d'une tâche
            $req = $bdd->prepare('UPDATE task SET name_task = :name_task, content_task = :content_task,  date_task = :date_task, validate_task = :validate_task,
            id_user = :id_user, id_cat = :id_cat WHERE id_task = :id_task');
            //éxécution de la requête SQL
            $req->execute(array(
            'id_task' => $idtask,   
            'name_task' => $nameTask,
            'content_task' => $contentTask,
            'date_task' => $dateTask,
            'validate_task'=>$validateTask,
            'id_user' => $idUserTask,
            'id_cat' => $idCat,
            ));
            //redirection vers show_task.php
            header("Location: show_task.php");
        }
        catch(Exception $e)
        {
        //affichage d'une exception en cas d’erreur
        die('Erreur : '.$e->getMessage());
        }
    }
?>  
