<?php

    class ManagerPDO
    {
        function dbConnect()
        {
            $db = new PDO("mysql:host=localhost;dbname=combats;charset=utf8","root","");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
            return $db;
        }

    }