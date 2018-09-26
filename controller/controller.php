<?php
    function chargerClasse($classname)
    {
        require('model/'.$classname.'.php');
    }

    spl_autoload_register('chargerClasse');

    function creerPersonnage($nom)
    {
        $perso = new Personnage(["nom" => $nom]);
        $manager = new PersonnageManager();

        if (!$perso->nomValide())
        {
            $message = 'Le nom choisi est invalide.';
            unset($perso);
        }
        elseif ($manager->exists($perso->nom()))
        {
            $message = 'Le nom du personnage est déjà pris.';
            unset($perso);
        }
        else
        {
            $manager->add($perso);
        }
        require("view/indexView.php");
    }

    function utiliserPersonnage($nom)
    {
        $manager = new PersonnageManager();
        if ($manager->exists($_POST['nom'])) // Si celui-ci existe.
        {
          $perso = $manager->get($_POST['nom']);
        }
        else
        {
          $message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
        }
        require("view/indexView.php");
    }

    function homepage()
    {
        require("view/indexView.php");
    }