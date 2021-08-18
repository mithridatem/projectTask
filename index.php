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
    //import du model
    include('./model/user.php');
    //import de la connexion à la bdd
    include('./utils/connexionbdd.php');    
    //import du menu
    include('view/menu.php');
    //import de la vue connexion
    include('view/view_connexion.php');     
    /*-----------------------------------------------------
                            Tests :
    -----------------------------------------------------*/    
    //test si les champs sont vides
    if(!isset($_POST['login_user']) AND !isset($_POST['mdp_user']))
    {   
       //script js récupération du paragraphe #message dans une variable "message"
       echo '<script>let message = document.querySelector("#message");';
       //script js remplacement du message
       echo 'message.innerHTML = "Veuillez remplir les champs du formulaire";';
       echo '</script>';
    }
    //test si les champs sont complétés
    if(isset($_POST['login_user']) AND isset($_POST['login_user']))
    {
        //création des variables de connexion
        $login = $_POST['login_user'];
        $mdp = $_POST['mdp_user'];
        //Nouvelle instance de User
        $user = new User("", "", "$login", "$mdp");
        //chiffrage du mot de passe en md
        $user->cryptMdp();
        //test si le compte existe (login)
        if($user->showUser($bdd))
        {   
            //test si le login et le mot de passe correspondent
            if($user->userConnnected($bdd))
            {
                //génération des super globales 
                $user->generateSuperGlobale($bdd);                
                //test login et mot de passe correct
                if($_SESSION['connected'])
                {
                    //redirection vers index.php?connected
                    header("Location: index.php?connected");
                }
            }
            //test mot de passe incorrect
            else
            {
                //redirection vers index.php?mdperror
                header("Location: index.php?mdperror");
            }                  
        }
        //test le compte n'existe pas
        else
        {
            //redirection vers index.php?cptnoexist
            header("Location: index.php?cptnoexist");
        }
    }
    /*-----------------------------------------------------
                Gestion des messages d'erreurs :
    -----------------------------------------------------*/
    //test si le compte (login) n'existe pas
    if(isset($_GET['cptnoexist']))
    {   
        //script js
        echo '<script>';
         //script js remplacement du message
        echo 'message.innerHTML = "Le compte n\'existe pas !!!";';
        echo '</script>';
    }
    //test si le mot de passe est incorrect
    if(isset($_GET['mdperror']))
    {   
        //script js
        echo '<script>';
         //script js remplacement du message
        echo 'message.innerHTML = "Le mot de passe est incorrect !!!";';
        echo '</script>';
    }
     //test connexion ok
     if(isset($_GET['connected']))
     {   
        
        //script js
        echo '<script>';
        //script js remplacement du message
        echo 'message.innerHTML = "Connecté !!!";';
        echo '</script>';   
    }
    //test deconnexion
    if(isset($_GET['deconnected']))
    {   
        //script js
        echo '<script>';
        //script js remplacement du message
        echo 'message.innerHTML = "Déconnecté !!!";';
        echo '</script>';
    }     
?>  
