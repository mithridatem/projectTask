<?php
    class Cat
    {
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/
        private $id_cat;
        private $name_cat;        
        /*-----------------------------------------------------
                                Constucteur :
        -----------------------------------------------------*/
        public function __construct($name_cat)
        {
            $this->name_cat = $name_cat;
        } 
        /*-----------------------------------------------------
                            Getter and Setter :
        -----------------------------------------------------*/
         //id_cat Getter and Setter
         public function getIdCat()
         {
             return $this->id_cat;
         }
         public function setIdTask($newIdCat)
         {
             $this->id_cat = $newIdCat;
         } 
         //name_cat Getter and Setter
         public function getNameCat()
         {
             return $this->name_cat;
         }
         public function setNameCat($newNameCat)
         {
             $this->name_cat = $newNameCat;
         }
        /*-----------------------------------------------------
                                Fonctions :
        -----------------------------------------------------*/
        //méthode création d'une catégorie
        public function createCat($bdd)
        {
            //récuparation des valeurs de l'objet
            $name_cat = $this->getNameCat();
            try
            {   
                //requête ajout d'une catégorie de tâche
                $req = $bdd->prepare('INSERT INTO cat(name_cat) 
                VALUES (:name_cat)');
                //éxécution de la requête SQL
                $req->execute(array(
                'name_cat' => $name_cat,                                                                 
            ));
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }        
        }
        //méthode généation d'une liste réroulante html depuis la table cat de la base de données
        public function generateMenu($bdd)
        {      
            try
            {                   
               //requête pour stocker le contenu de toute la table task dans le tableau $donnees
               $reponse = $bdd->query('SELECT * FROM cat');
               //parcours du résultat de la requête
               while($donnees = $reponse->fetch())
               {   
                  //liste deroulante <select> html
                  echo '<option value="'.$donnees['id_cat'].'">'.$donnees['name_cat'].'</option>';
               }                
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }
        }        
    }
?>