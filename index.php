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






