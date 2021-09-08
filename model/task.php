<?php
    class Task{
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/
        private $id_task;
        private $name_task;
        private $content_task;
        private $date_task;
        //par défaut la tache est à un état de false (non validé ou terminé)
        private $validate_task = false;
        //par défaut la tache est attribué à l'utilisateur qui à comme id 1
        private $id_user;
        //par défaut la tache est attribué à la catégorie qui à comme id 1
        private $id_cat;
        /*-----------------------------------------------------
                                Constucteur :
        -----------------------------------------------------*/
        /*le constructeur ne prend en entrée que le name, content et la date, l'attribut (idUser)
        est récupéré par la connexion (super globale session $_SESSION['idUser']) et la catgorie est recupérée 
        depuis formulaire de création d'une tâche depuis un menu déroulant
        la valeur par défaut de validate est à "false" (tache en cours terminé à true)*/
        public function __construct()
        {
        }
        /*-----------------------------------------------------
                            Getter and Setter :
        -----------------------------------------------------*/
        //id_task Getter and Setter
        public function getIdTask()
        {
            return $this->id_task;
        }
        public function setIdTask($newIdTask)
        {
            $this->id_task = $newIdTask;
        } 
        //name_task Getter and Setter
        public function getNameTask()
        {
            return $this->name_task;
        }
        public function setNameTask($newNameTask)
        {
            $this->name_task = $newNameTask;
        }
        //content_task Getter and Setter
        public function getContentTask()
        {
            return $this->content_task;
        }
        public function setContentTask($newContentTask)
        {
            $this->content_task = $newContentTask;
        }
        //date_task Getter and Setter
        public function getDateTask()
        {
            return $this->date_task;
        }
        public function setDateTask($newDateTask)
        {
            $this->date_task = $newDateTask;
        }
        //validate_task Getter and Setter
        public function getValidateTask()
        {
            return $this->validate_task;
        }
        public function setValidateTask($validate_task)
        {
            $this->validate_task = $validate_task;
        }
        //id_user Getter and Setter
        public function getIdUserTask()
        {
            return $this->id_user;
        }
        public function setIdUserTask($id_user)
        {
            $this->id_user = $id_user;
        }
        //id_cat Getter and Setter
        public function getIdCat()
        {
            return $this->id_cat;
        }
        public function setIdCat($id_cat)
        {
            $this->id_cat = $id_cat;
        }    
        /*-----------------------------------------------------
                                Fonctions :
        -----------------------------------------------------*/
        //méthode ajout d'une tâche en bdd
        public function createTask($bdd)
        {   
            //récuparation des valeurs de l'objet
            $name_task = $this->getNameTask();
            $content_task = $this->getContentTask();
            $date_task = $this->getDateTask();
            $id_user = $this->getIdUserTask();
            $id_cat = $this->getIdCat();
            try
            {   
                //requête ajout d'une tâche
                $req = $bdd->prepare('INSERT INTO task(name_task, content_task, date_task, validate_task, id_user, id_cat) 
                VALUES (:name_task, :content_task, :date_task, :validate_task, :id_user, :id_cat)');
                //éxécution de la requête SQL
                $req->execute(array(
                'name_task' => $name_task,
                'content_task' => $content_task,
                'date_task' => $date_task,
                'validate_task'=>0,
                'id_user' => $id_user,
                'id_cat' => $id_cat,
            ));
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }        
        }
        //méthode affichage de toutes les tâches
        public function showAllTask($bdd)
        {   
            //récupération de l'id de l'utilisateur depuis la connexion ($_SESSION['idUser'])
            $idUser = $_SESSION['idUser'];
            try
            {   //requête qui récupére toutes les tâches non terminées d'un utilisateur
                $reponse = $bdd->query('SELECT id_task, name_task, date_task FROM task WHERE validate_task=0 and id_user = '.$idUser.'');
                //boucle pour parcourir et afficher le contenu de chaque ligne de la requete
                while ($donnees = $reponse->fetch())
                {   //affichage du contenu de la requete
                    //quand on clique sur un élément du tableau on lance la fonction js openModal2 qui va lancer le popup
                    //et éxécuter la requéte ajax quand on enregistre
                    echo '<tr><td><p><input type="checkbox" name="id_task[]" value="'.$donnees['id_task'].'"/>
                    <a href="#" onclick="openModal('.$donnees['id_task'].')"  
                    id="'.$donnees['id_task'].'">'.$donnees['name_task'].' , 
                     pour le : '.$donnees['date_task'].'</p></a></td></tr>';                    
                }
            }
            catch(Exception $e)
            {   //affichage d'une exception
                die('Erreur : '.$e->getMessage());
            }
        }
        //méthode update task (valider une tâche)
        public function validateTask($bdd, $value)
        {
            try
            {
                //requete pour update le statut de la tache = 1 (true)
                $req = $bdd->query('UPDATE task SET validate_task = 1 Where id_task ='.$value.'');
                 //redirection vers show_task.php
                 header("Location: show_task.php");
            }
            catch(Exception $e)
            {   //affichage d'une exception
                die('Erreur : '.$e->getMessage());
            }
        }
        //méthode affichage des informations d'une tâche
        public function getTask($bdd, $pId)
        {
            try
            {
                $reponse = $bdd->query('SELECT id_task, name_task, content_task, date_task, cat.id_cat, cat.name_cat FROM task 
                INNER JOIN cat WHERE task.id_cat = cat.id_cat AND id_task='.$pId.'');
                //boucle pour parcourir et afficher le contenu de chaque ligne de la requete
                while ($donnees = $reponse->fetch())
                {   
                    //affichage du contenu d'une tâchedepuis la requête sql
                    echo '<input type="text" name ="id_task" id = "id_task" value="'.$donnees['id_task'].'">';
                    echo '<p>Nom de la tâche :</p>';
                    echo '<p><input type="text" name ="name_task" value="'.$donnees['name_task'].'"></p>';
                    echo '<p>Contenu de la  tâche:</p>';
                    echo '<p><textarea name="content_task" rows="5" cols="33">'.$donnees['content_task'].'</textarea></p>';
                    echo '<p>Date de fin:</p>';
                    echo '<p><input type="date" name="date_task" value="'.$donnees['date_task'].'"></p>';
                    echo '<p>Type de  tâche:</p>';
                    echo '<p><select name="id_cat">';
                    echo '<p><option value="'.$donnees['id_cat'].'" selected>'.$donnees['name_cat'].'</option></p>';                   
                }
            }
            catch(Exception $e)
            {   //affichage d'une exception
                die('Erreur : '.$e->getMessage());
            }
        }
        //méthode mise à jour d'une tâche
        public function updatetask($bdd)
        {    
            //récuparation des valeurs de l'objet
            $id_task = $this->getIdTask();
            $name_task = $this->getNameTask();
            $content_task = $this->getContentTask();
            $date_task = $this->getDateTask();
            $id_user = $this->getIdUserTask();
            $id_cat = $this->getIdCat();            
            try
            {   
                //requête SQL mise àjour d'une tâche (update)
                $req = $bdd->prepare('UPDATE task SET name_task = :name_task, content_task = :content_task,  date_task = :date_task, validate_task = :validate_task,
                id_user = :id_user, id_cat = :id_cat WHERE id_task = :id_task');
                //éxécution de la requête SQL
                $req->execute(array(
                'id_task' => $id_task,   
                'name_task' => $name_task,
                'content_task' => $content_task,
                'date_task' => $date_task,
                'validate_task'=> 0,
                'id_user' => $id_user,
                'id_cat' => $id_cat,
            ));
                //redirection vers show_task.php
                header("Location: show_task.php?update_task=true&idtask=$id_task");
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            } 
        }
    }
?>