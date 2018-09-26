<?php
require("controller/controller.php");

try
{
   if($_GET["machin"] > 0)
   {

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






