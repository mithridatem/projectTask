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
    //test si l'id de la tache existe
    if(isset($_GET['ID']))
    {
        $id_task = $_GET['ID'];
        //affiche l'id de la tâche
        echo "l'id de la tache est égal à : $id_task";
        echo '<br>';
        //affiche l'idUser de la session
        echo 'l\'id de l\'utilisateur est égal à : '.$_SESSION['idUser'].'';
        echo '<br>';
    
        echo '<form action="./show_task.php"  method="get">'; 
         
        $task1 = new Task();
        $task1->getTask($bdd,$id_task);
        echo '<p>Type de  tâche:</p>';
        echo '<p><select name="id_cat">';    
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