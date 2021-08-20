<header>   
    <nav>
        <div class="subnav">
            <img src="./image/menu.svg"  class="burgerButton" width="40px">
            <div>
                <img src="./image/clipboard.svg"  width="40px">
                <h1>Project Task</h1>
            </div>
        </div>
        <ul>
<?php
    /*-----------------------------------------------------
                        Menu dynamique :
        -----------------------------------------------------*/
    //si l'utilisateur est connecté (connexion, ajouter categorie, ajouter tâche, deconnexion)
    if(isset($_SESSION['connected']))
    {
        echo '        
            <a href="./add_cat.php"><li class="categories">Ajouter une categorie</li></a>
            <a href="./add_task.php"><li class="taches">Ajouter une tâche</li></a>
            <a href="./show_task.php"><li class="afficher">Afficher les tâches</li></a>
            <a href="./deconnected.php"><li class="deco" >Deconnexion</li></a>';
    }
    //si l'utilisateur n'est pas connecté (connexion, ajouter compte, deconnexion)  
    else
    {
        echo '
            <a href="./index.php"><li class="connexion">Connexion</li></a>
            <a href="./add_user.php"><li class="comptes">Ajouter compte</li></a>';  
    }
?>            
        </ul>            
    </nav>
</header>