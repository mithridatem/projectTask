<?php
    class User
    {   
        /*-----------------------------------------------------
                            Attributs :
        -----------------------------------------------------*/  
        private $id_user;
        private $name_user;
        private $first_name_user;
        private $login_user;
        private $mdp_user;
        /*-----------------------------------------------------
                            Constucteur :
        -----------------------------------------------------*/        
        public function __construct($name_user, $first_name_user, $login_user, $mdp_user)
        {   $this->name_user = $name_user;
            $this->first_name_user = $first_name_user;
            $this->login_user = $login_user;
            $this->mdp_user = $mdp_user;
        }
        /*-----------------------------------------------------
                        Getter and Setter :
        -----------------------------------------------------*/
        //id_user Getter and Setter
        public function getIdUser()
        {
            return $this->id_user;
        }
        public function setIdUser($newIdUser)
        {
            $this->id_user = $newIdUser;
        }
        //name_user Getter and Setter
        public function getNameUser()
        {
            return $this->name_user;
        }
        public function setNameUser($newNameUser)
        {
            $this->name_user = $newNameUser;
        }
        //first_name_user Getter and Setter
        public function getFirstNameUser()
        {
            return $this->first_name_user;
        }
        public function setFirstNameUser($newFirstNameUser)
        {
            $this->first_name_user = $newFirstNameUser;
        }
        //login_user Getter and Setter
        public function getLoginUser()
        {
            return $this->login_user;
        }
        public function setLoginUser($newLoginUser)
        {
            $this->login_user = $newLoginUser;
        }
        //mdp_user Getter and Setter
        public function getMdpUser()
        {
            return $this->mdp_user;
        }
        public function setMdpUser($newMdpUser)
        {
            $this->mdp_user = $newMdpUser;
        }
        /*-----------------------------------------------------
                            Fonctions :
        -----------------------------------------------------*/
        //methode chiffrage d'un mot du mot de passe en md5 :
        public function cryptMdp(){
            $this->setMdpUser(md5($this->getMdpUser()));
        }     
        //méthode ajout d'un utilisateur en bdd
        public function createUser($bdd)
        {   
            //récuparation des valeurs de l'objet
            $name_user = $this->getNameUser();
            $first_name_user = $this->getFirstNameUser();
            $login_user = $this->getLoginUser();
            $mdp_user = $this->getMdpUser();        
            try
            {   
                //requête ajout d'un utilisateur
                $req = $bdd->prepare('INSERT INTO user(name_user, first_name_user, login_user, mdp_user) 
                VALUES (:name_user, :first_name_user, :login_user, :mdp_user)');
                //éxécution de la requête SQL
                $req->execute(array(
                'name_user' => $name_user,
                'first_name_user' => $first_name_user,
                'login_user' => $login_user,
                'mdp_user' => $mdp_user,                                                                 
            ));
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }        
        }
        //méthode pour vérifier si un utilisateur existe dans la bdd
        public function showUser($bdd)
        {
             //récuparation des valeurs de l'objet       
             $login_user = $this->getLoginUser();        
             try
             {                   
                //requête pour stocker le contenu de toute la table le contenu est stocké dans le tableau $reponse
                $reponse = $bdd->query('SELECT * FROM user WHERE login_user = "'.$login_user.'" 
                 LIMIT 1');
                //parcours du résultat de la requête
                while($donnees = $reponse->fetch())
                {   
                   //return $donnees['mdp_user'];
                    if($login_user == $donnees['login_user'])
                    {
                        //retourne true si il existe
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }                
             }
             catch(Exception $e)
             {
             //affichage d'une exception en cas d’erreur
             die('Erreur : '.$e->getMessage());
             }        
        }
        //méthode qui génére les super globales avec les valeurs d'attributs d'un utilisateur en bdd
        public function generateSuperGlobale($bdd)
        {
            //récuparation des valeurs de l'objet       
            $login_user = $this->getLoginUser();        
            $mdp_user = $this->getMdpUser();        
            try
            {                   
               //requête pour stocker le contenu de toute la table le contenu est stocké dans le tableau $reponse
               $reponse = $bdd->query('SELECT * FROM user WHERE login_user = "'.$login_user.'" AND mdp_user = "'.$mdp_user.'" LIMIT 1');
               //parcours du résultat de la requête
               while($donnees = $reponse->fetch())
               {   
                  //return $donnees['mdp_user'];
                   if($login_user == $donnees['login_user'] AND $mdp_user == $donnees['mdp_user'])
                   {
                        $id =  $donnees['id_user'];
                        $name =  $donnees['name_user'];
                        $fisrtName =  $donnees['first_name_user'];
                        $login =  $donnees['name_user'];
                        $mdp =  $donnees['mdp_user'];
                        //création des super globales Session                
                        $_SESSION['idUser'] =  $id;
                        $_SESSION['nameUser'] = $name;
                        $_SESSION['firstNameUser'] =  $fisrtName;
                        $_SESSION['loginUser'] = $login;
                        $_SESSION['mdpUser'] = $mdp;
                        $_SESSION['connected'] = true;
                   }
               }                
            }
            catch(Exception $e)
            {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
            }   
        }
         
        //méthode pour tester la connexion d'un utilisateur
        public function userConnnected($bdd)
        {
             //récuparation des valeurs de l'objet       
             $login_user = $this->getLoginUser();        
             $mdp_user = $this->getMdpUser();        
             try
             {                   
                //requête pour stocker le contenu de toute la table le contenu est stocké dans le tableau $reponse
                $reponse = $bdd->query('SELECT * FROM user WHERE login_user = "'.$login_user.'" 
                AND mdp_user = "'.$mdp_user.'" LIMIT 1');
                //parcours du résultat de la requête
                while($donnees = $reponse->fetch())
                {   
                   //return $donnees['mdp_user'];
                    if($login_user == $donnees['login_user'] AND $mdp_user == $donnees['mdp_user'])
                    {
                        //retourne true si il existe (login en mdp)
                        return true;
                    }
                    else
                    {
                        return true;
                    }
                }                
             }
             catch(Exception $e)
             {
             //affichage d'une exception en cas d’erreur
             die('Erreur : '.$e->getMessage());
             }        
        }
         //méthode génération d'un token de connexion
         public function createToken($bdd)
         {  
             //récuparation des valeurs de l'objet
            $login_user = $this->getLoginUser();
            $mdp_user = $this->getMdpUser();
            //chaine token en clair
            $token = "$login_user$mdp_user";
            //encodage en md5 du token
            $token = md5($token);
            //retourne le token 
            return $token;    
         }
         //méthode mise à jour des informations d'un utilisateur nom et prénom
         public function updateUser($bdd)
         {

         }
         //méthode mise à jour du login d'un utilisateur
         public function updateLoginUser($bdd)
         {

         }
         //méthode mise à jour du mot de passe d'un utilisateur
         public function updateMdpUser($bdd)
         {

         }
    }
?>