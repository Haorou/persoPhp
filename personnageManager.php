<?php
    class PersonnageManager
    {
        private $_db;

        public function __construct($db)
        {
          $this->setDb($db);
        }

        public function setDb($db)
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
            
        }




















    }





