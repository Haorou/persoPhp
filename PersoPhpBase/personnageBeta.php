<?php
class Personnage
{
    private $_name = "anonymous";
    private $_health = 100;
    private $_experience = 0;
    private $_strength = 10;

    private static $_compteur;

    public function __construct()
    {
        self::$_compteur += 1;
    }

    public static function displayCompteur()
    {
        echo "Il y a " , self::$_compteur , " personnage(s)";
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function displayExperience()
    {
        echo $this->_name , " à " , $this->_experience , " points d'expérience /";
    }

    public function getExperience(int $quantity)
    {
        $this->_experience += $quantity;
    }

    public function getHit(int $quantity)
    {
        $this->_health -= $quantity;
    }

    public function hitSomeone(Personnage $someone)
    {
        $someone->getHit($this->_strength); 
    }

    public function displayLife()
    {
        echo $this->_name , " à " , $this->_health , " points de vies /";
    }

}

$perso1 = new Personnage;
$perso1->setName("Louis");

$perso2 = new Personnage;
$perso2->setName("Elise");

$perso2->hitSomeone($perso1);
$perso2->getExperience(25);

$perso1->displayExperience();
$perso2->displayExperience();

$perso1->displayLife();
$perso2->displayLife();

Personnage::displayCompteur();

?>