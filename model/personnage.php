<?php
    class Personnage
    {
        private $_id;
        private $_nom;
        private $_degats;

        const CEST_MOI = 1;
        const PERSONNAGE_TUE = 2;
        const PERSONNAGE_FRAPPE = 3;      

        public function __construct(array $donnes)
        {
            $this->hydrate($donnes);
        }

        public function hydrate(array $donnes)
        {
            foreach($donnes as $cles => $values)
            {
                $method = "set" .uc_first($cles);
                if(method_exists($this,$method))
                {
                    $this->$method($values);
                }
            }
        }

        public function id() { return $this->_id; }

        public function nom() { return $this->_nom; }

        public function degats() { return $this->_degats; }

        public function setId($id)
        {
            $id = (int)$id;
            if($id > 0)
            {
                $this->_id = $id;
            }
        }

        public function setNom($nom)
        {
            if(is_string($nom))
            {
                $this->_nom = $nom;
            }
        }

        public function setDegats($degats)
        {
            $degats = (int)$degats;

            if($degats >= 0 && $degats <= 100)
            {
                $this->_degats = $degats;
            }            
        }

        public function frapper(Personnage $perso)
        {
            if($perso->id() == $this->id())
            {
                return self::CEST_MOI;
            }

            return $perso->recevoirDegats();
        }

        public function recevoirDegats()
        {
            $this->_degats += 5;

            if($this->degats() >= 100)
            {
                return self::PERSONNAGE_TUE;
            }
            
            return self::PERSONNAGE_FRAPPE;
        }

        public function nomValide()
        {
            return !empty($this->_nom);
        }
    }