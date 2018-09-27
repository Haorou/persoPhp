<?php
    class Personnage
    {
        private $_id;
        private $_nom;
        private $_degats;
        private $_experience;
        private $_niveau;
        private $_puissance;

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
                $method = "set" .ucfirst($cles);

                if(method_exists($this,$method))
                {
                    $this->$method($values);
                }
            }
        }

        public function experience() {return $this->_experience;}

        public function niveau() { return $this->_niveau;}

        public function puissance() { return $this->_puissance;}

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

        public function setNiveau($niveau)
        {
            $niveau = (int) $niveau;
            if($niveau >=1 && $niveau <=100)
            {
                $this->_niveau = $niveau;
            }
        }

        public function setExperience($experience)
        {
            $experience = (int) $experience;
            if($experience >=0)
            {
                $this->_experience = $experience;
                $this->ajoutNiveau();
            }
        }

        public function setPuissance($puissance)
        {
            $puissance = (int) $puissance;
            if($puissance >=1)
            {
                $this->_puissance = $puissance;
            }
        }

        public function ajoutExperience($quantiteExp)
        {
            $quantiteExp = (int) $quantiteExp;

            if($quantiteExp >=0)
            {
                $this->_experience += $quantiteExp;
                $this->ajoutNiveau();
            }
        }

        public function ajoutNiveau()
        {
            while($this->experience() >= $this->plafond())
            {
                $this->_niveau += 1;
                $this->ajoutPuissance();
            }
        }

        public function ajoutPuissance()
        {
            $puissance = $this->puissance();

            if($this->niveau() >1 && $this->niveau() <= 10)
                $puissance += 1;
            elseif($this->niveau() > 10 && $this->niveau() <= 25)
                $puissance += 2;
            elseif($this->niveau() > 25 && $this->niveau() <= 50)
                $puissance += 3;
            elseif($this->niveau() > 50 && $this->niveau() <= 75)
                $puissance += 4;
            else
                $puissance += 5;
            
            $this->setPuissance($puissance);
        }
        

        public function plafond()
        {
            $plafond = 100;
            $plafond += 25 * ($this->niveau() / 2);
            $multiplicateur = 1;
            if($this->niveau() >1 && $this->niveau() <= 10)
                $multiplicateur = (1.1 * $this->niveau());
            elseif($this->niveau() > 10 && $this->niveau() <= 25)
                $multiplicateur = (1.25 * $this->niveau());
            elseif($this->niveau() < 25 && $this->niveau() <= 50)
                $multiplicateur = (1.6 * $this->niveau());
            elseif($this->niveau() > 50 && $this->niveau() <= 75)
                $multiplicateur = (2 * $this->niveau());
            else
                $multiplicateur = (2.5 * $this->niveau());
            
            return ($plafond * $multiplicateur);
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


           $this->ajoutExperience(20 * $perso->niveau()); 

            return $perso->recevoirDegats($this->puissance());
        }

        public function recevoirDegats($puissance)
        {
            $this->_degats += $puissance;

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