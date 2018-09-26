<?php
require_once("model/ManagerPDO.php");

    class PersonnageManager extends managerPDO
    {
        private $_db;

        public function __construct()
        {
            $db = $this->dbConnect();
            $this->setDb($db);
        }

        public function setDb(PDO $db)
        {
            $this->_db = $db;
        }

        public function add(Personnage $perso)
        {
            $addPerso = $this->_db->prepare("INSERT INTO personnages(nom) 
                                        VALUES(:nom)");
            $addPerso->execute(array(
                                "nom" => $perso->nom()));

            $perso->hydrate(['id' => $this->_db->lastInsertId(),
                            'degats' => 0,]);
        }

        public function update(Personnage $perso)
        {
            $updatePerso = $this->_db->prepare("UPDATE personnages
                                        SET nom = :nom, degats = :degats
                                        WHERE id = :id)");
            $updatePerso->execute(array(
                                "nom" => $perso->nom(),
                                "degats" => $perso->degats(),
                                "id" => $perso->id()));
        }

        public function delete(Personnage $perso)
        {
            $deletePerso = $this->_db->prepare("DELETE FROM personnages
                                        WHERE id = :id)");
            $deletePerso->execute(array(
                                "id" => $perso->id()));
        }

        public function getList()
        {
            $selectPerso = $this->_db->query("SELECT * FROM personnages");
            $listeDePersonnages = [];

            while($perso = $selectPerso->fetch())
            {
                $listeDePersonnages[] = new Personnage($perso);
            }
            
            return $listeDePersonnages;
        }

        public function count()
        {
            return $this->_db->query("SELECT COUNT(*) FROM personnages")->fetchColumn();
        }

        public function exists($info)
        {
            if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
            {
              return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
            }
            
            // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
            
            $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
            $q->execute([':nom' => $info]);
            
            return (bool) $q->fetchColumn();
        }

        public function get($info)
        {
            if (is_int($info))
            {
              $q = $this->_db->query('SELECT id, nom, degats FROM personnages WHERE id = '.$info);
              $donnees = $q->fetch(PDO::FETCH_ASSOC);
              
              return new Personnage($donnees);
            }
            else
            {
              $q = $this->_db->prepare('SELECT id, nom, degats FROM personnages WHERE nom = :nom');
              $q->execute([':nom' => $info]);
            
              return new Personnage($q->fetch(PDO::FETCH_ASSOC));
            }
        }




















    }





