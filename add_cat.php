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
    //fichiers à appeler pour ajouter un utilisateur en base de données
    //ajout du model (class user)
    include('./model/category.php');
    //ajout du fichier de connexion 
    //(à modifier en fonction de votre base de données dans mon cas la bdd l'appele task1)
    include('./utils/connexionbdd.php');
    //ajout du menu
    include('./view/menu.php');
    //import de la vue view_add_user.php (formulaire d'insertion d'un utilisateur)
    include('./view/view_add_cat.php');     
    /*-----------------------------------------------------
                            Tests :
    -----------------------------------------------------*/
    //test si le champ du formulaire est complété
    if(isset($_POST['name_cat']))
    {   
        //création d'un objet depuis la valeur contenue dans le formulaire
        $cat = new Cat($_POST['name_cat']);
        //appel de la méthode pour ajouter une categorie de tâche en bdd
        $cat->createCat($bdd);
        echo '<p>la catégorie : <span>'.$cat->getNameCat().'</span> 
        à était ajoutée !!!</p></div>';
    }
    else
    {
        echo '<p id="#message">Veuillez remplir le champ de formulaire.</p></div>';
    }
?>