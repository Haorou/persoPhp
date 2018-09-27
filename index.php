<?php
require("controller/controller.php");

try
{
    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "interragir")
        {
            if(isset($_POST["creer"]) && isset($_POST["nom"]))
            {
                creerPersonnage($_POST["nom"]);
            }
            else if(isset($_POST["utiliser"]) && isset($_POST["nom"]))
            {
                utiliserPersonnage($_POST["nom"]);
            }
        }
        elseif($_GET["action"] == "deconnexion")
        {
            if(isset($_POST["deconnexion"]))
            {
                deconnexionPersonnage();
            }
        }
        elseif($_GET["action"] == "frapper")
        {
            if(isset($_GET["id"]))
            {
                frapperPersonnage($_GET["id"]);
            }
            else
            {
                throw new Exception("Frapper ou Id are not set");
            }
        }
    }
   else
   {
       homepage();
   }

}
catch(Execption $e)
{
    die($e->getMessage());
}






