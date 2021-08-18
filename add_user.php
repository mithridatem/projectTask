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
    //fichier à appeler pour ajouter un utilisateur en base de données

    //ajout du model (class user)
    include('./model/user.php');
    //ajout du fichier de connexion 
    //(à modifier en fonction de votre base de données dans mon cas la bdd l'appele task1)
    include('./utils/connexionbdd.php');
    //ajout du menu
    include('./view/menu.php');
    //import de la vue view_add_user.php (formulaire d'insertion d'un utilisateur)
    include('./view/view_add_user.php');   
    /*-----------------------------------------------------
                            Tests :
    -----------------------------------------------------*/
    //test si les champs du formulaire sont remplis
    if(isset($_POST['name_user'])and isset($_POST['first_name_user']) 
    and isset($_POST['login_user']) and isset($_POST['mdp_user']))
    {
        //création d'un objet depuis les valeurs contenues dans le formulaire
        $user = new User($_POST['name_user'], $_POST['first_name_user'], $_POST['login_user'], $_POST['mdp_user']);        
        //test si l'utilisateur existe déja
        //appel de la méthode de detectchUser($bdd)
        if($user->showUser($bdd))
        {   
            //réponse si l'utilisateur existe déja
            echo '<p>l\'utilisateur qui à pour nom : <span>'.$_POST['name_user'].'</span> 
            , prénom : <span>'.$_POST['first_name_user'].'</span> et 
            login : <span>'.$_POST['login_user'].'</span> existe déja !!!</p><div>';
        }
        //test si l'utilisateur n'existe pas
        else
        {   
            //appel de la méthode encodage du mot de passe au format md5
            $user->cryptMdp();
            $user->createUser($bdd);
            //réponse si l'utilisateur existe déja
            echo '<p>l\'utilisateur qui à pour nom : <span>'.$_POST['name_user'].'</span> 
            et prénom : <span>'.$_POST['first_name_user'].'</span> login : 
            <span>'.$_POST['login_user'].'</span> et pour mot de passe : <span>'.md5($_POST['first_name_user']).'
            </span> à été ajouté !!!</p><div>';           
        }        
    }
    //test si les champs de formulaire ne sont pas remplis 
    else
    {
        echo '<p>Veuillez remplir les champs de formulaire.</p><div>';
    }    
?>