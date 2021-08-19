<?php
    /*-----------------------------------------------------
                        Session :
    -----------------------------------------------------*/
    //création de la session
    session_start();
    /*-----------------------------------------------------
                        Imports :
    -----------------------------------------------------*/ 
    //fichiers à appeler pour ajouter un utilisateur en base de données
    //ajout du model (class User)
    include('./model/task.php');
    //ajout du model (class cat)
    include('./model/category.php');
    //ajout du fichier de connexion 
    //(à modifier en fonction de votre base de données dans mon cas la bdd l'appele task1)
    include('./utils/connexionbdd.php');
    //ajout du menu
    include('./view/menu.php');
    //import de la vue view_add_user.php (formulaire d'insertion d'un utilisateur)
    include('./view/view_add_task.php'); 
    /*-----------------------------------------------------
                            Tests :
    -----------------------------------------------------*/
    //test si le champ du formulaire est complété
    if(isset($_POST['name_task']) AND isset($_POST['content_task']) AND $_POST['date_task'])
    {   
        //création d'un objet depuis la valeur contenue dans le formulaire
        $task= new Task();
        $task->setNameTask($_POST['name_task']);
        $task->setContentTask($_POST['content_task']);
        $task->setDateTask($_POST['date_task']);
        //récupération de l'id de l'utilisateur
        $task->setIdUserTask($_SESSION['idUser']);
        $task->setIdCat($_POST['id_cat']);
        $task->createTask($bdd);
        echo '<p>La tâche : '.$_POST['name_task'].' a été ajouté </p></div>';    
    }
    else
    {
        echo '<p>Veuillez remplir les champs de formulaire nom, contenu et date.</p></div>';
    }
?> 