<?php
    session_start();
    include('../model/task.php');
    include('../utils/connexionbdd.php');
    /*$new_task = new task();
    $new_task->setIdTask($_GET['id_task']);
    $new_task->setNameTask($_GET['name_task']);
    $new_task->setContentTask($_GET['content_task']);
    $new_task->setDateTask($_GET['date_task']);
    $new_task->setIdCat($_GET['id_cat']);
    $new_task->setIdUserTask($_SESSION['id_user']);*/
    
    //variables
    $idtask= $_GET['id_task'];
    $nameTask= $_GET['name_task'];
    $contentTask = $_GET['content_task'];
    $dateTask = $_GET['date_task'];
    $idCat = $_GET['id_cat'];
    $validateTask = 0;
    $idUserTask = $_SESSION['idUser'];

    try
            {   
                //requête ajout d'une tâche
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
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }
?>