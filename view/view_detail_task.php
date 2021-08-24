<?php
    /*-----------------------------------------------------
                        Session :
    -----------------------------------------------------*/
    //création de la session
    session_start();
    /*-----------------------------------------------------
                        Imports :
    -----------------------------------------------------*/
    //import de la connexion à la bdd
    include('../utils/connexionbdd.php');
    //import de la classe task
    include('../model/task.php');
    //import de la classe cat
    include('../model/category.php');
    /*-----------------------------------------------------
                        Tests :
    -----------------------------------------------------*/   
    //test si l'id de la tache existe dans l'url méthode GET (ID)
    if(isset($_GET['ID']))
    {
        $id_task = $_GET['ID'];
        echo '<p id ="title_update_task">Mettre à jour une tâche</p>';
        echo '<form action="./show_task.php"  method="get" id= "form_detail_task">'; 
        //création d'un objet task 
        $task1 = new Task();
        //appelde la méthode qui affiche le détail d'une tâche à partir de son id_task
        $task1->getTask($bdd,$id_task);       
        //création d'un objet category
        $cat = new Cat("test");
        //appel de la Méthode génération du menu déroulant liste des catégories
        $cat->generateMenu($bdd);           
        ?>
         </select></p>   
        <p><input type="submit" value="update"></p>
        </form>
    <?php
    }
 ?> 