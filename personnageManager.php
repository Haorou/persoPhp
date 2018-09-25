<?php
    class PersonnageManager
    {
        private $_db;

        public function __construct($db)
        {
          $this->setDb($db);
        }

        public function setDb(PDO $db)
        {
            $this->_db = $db;
        }

        public function add(Personnage $perso)
        {
            $addPerso = $this->_db->prepare("INSERT INTO personnage(nom, degats) 
                                        VALUES(:nom, :degats)");
            $addPerso->execute(array(
                                "nom" => $perso->nom(),
                                "degats" => $perso->degats()));
        }

        public function update(Personnage $perso)
        {
            $updatePerso = $this->_db->prepare("UPDATE personnage
                                        SET nom = :nom, degats = :degats
                                        WHERE id = :id)");
            $updatePerso->execute(array(
                                "nom" => $perso->nom(),
                                "degats" => $perso->degats(),
                                "id" => $perso->id()));
        }

        public function delete(Personnage $perso)
        {
            $deletePerso = $this->_db->prepare("DELETE FROM personnage
                                        WHERE id = :id)");
            $deletePerso->execute(array(
                                "id" => $perso->id()));
        }

        public function getList()
        {
            $selectPerso = $this->_db->query("SELECT * FROM personnage");
            $listeDePersonnages = [];

            while($perso = $selectPerso->fetch())
            {
                $listeDePersonnages[] = new Personnage($perso);
            }
            
            return $listeDePersonnages;
        }

        public function count()
        {
            $count = $this->_db->query("SELECT count(*) FROM personnage");
        }

        public function exists($info)
        {
            $isExist = False;
            if(is_int($info))
            {
                $isExist = $this->_db->prepare("SELECT * FROM personnage WHERE id = :id");
                $isExist->execute(array(
                                "id" => $info));
            }
            else
            {
                if(is_string($info))
                {
                    $isExist = $this->_db->prepare("SELECT * FROM personnage WHERE nom = :nom");
                    $isExist->execute(array(
                                    "nom" => $info));
                }
            }
            return $isExist;
        }

        #### A METTRE A JOUR A PARTIR DICI !!!!!!!!
        public function get($info)
        {

            $isExist = False;
            if(is_int($info))
            {
                $isExist = $this->_db->prepare("SELECT * FROM personnage WHERE id = :id");
                $isExist->execute(array(
                                "id" => $info));
            }
            else
            {
                if(is_string($info))
                {
                    $isExist = $this->_db->prepare("SELECT * FROM personnage WHERE nom = :nom");
                    $isExist->execute(array(
                                    "nom" => $info));
                }
            }
            return $isExist;
        }




















    }





