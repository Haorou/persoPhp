<?php
    function chargerClasse($classname)
    {
        require('model/'.$classname.'.php');
    }

    spl_autoload_register('chargerClasse');
    session_start();

    function creerPersonnage($nom)
    {
        $perso = new Personnage(["nom" => $nom, "niveau" => 1, "experience" => 0, "puissance" => 1]);
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
          $_SESSION["perso"] = $manager->get($_POST['nom']);

        }
        else
        {
          $message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
        }
        require("view/indexView.php");
    }

    function frapperPersonnage($id)
    {
        $manager = new PersonnageManager();
        if (!$manager->exists((int) $id))
        {
            $message = 'Le personnage que vous voulez frapper n\'existe pas !';
        }
        else
        {
            $persoAFrapper = $manager->get((int) $id);
        
            $retour =  $_SESSION["perso"]->frapper($persoAFrapper); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.
        
            switch ($retour)
            {
                case Personnage::CEST_MOI :
                    $message = 'Mais... pourquoi voulez-vous vous frapper ???';
                    break;
                
                case Personnage::PERSONNAGE_FRAPPE :
                    $message = 'Le personnage a bien été frappé !';
                    
                    $manager->update( $_SESSION["perso"]);
                    $manager->update($persoAFrapper);   
                    break;
                
                case Personnage::PERSONNAGE_TUE :
                    $message = 'Vous avez tué ce personnage !';
                    
                    $manager->update( $_SESSION["perso"]);
                    $manager->delete($persoAFrapper);
                    break;
            }
        }
        require("view/indexView.php");
    }

    function deconnexionPersonnage()
    {
        $manager = new PersonnageManager();
        session_destroy();
        session_start();
        require("view/indexView.php");
        exit();
    }

    function homepage()
    {
        $manager = new PersonnageManager();
        require("view/indexView.php");
    }