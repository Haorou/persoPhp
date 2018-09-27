<!DOCTYPE html>
<html>
    <head>
        <title>TP : Mini jeu de combat</title>    
        <meta charset="utf-8" />
    </head>

    <body>
        <p>Nombre de personnages créés : <?php 
                                        if(isset($manager)) { echo $manager->count(); } 
                                        ?></p>

            <?php
            if (isset($message)) // On a un message à afficher ?
                echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
            ?>

        <form action="index.php?action=interragir" method="post">
            <p>
                Nom : <input type="text" name="nom" maxlength="50" />
                <input type="submit" value="Créer ce personnage" name="creer" />
                <input type="submit" value="Utiliser ce personnage" name="utiliser" />
            </p>
        </form>

        <?php if(isset($_SESSION["perso"])) { ?>
            <p>Personnage sélectionné : <?= $_SESSION["perso"]->nom()?><br>
                Il a pris : <?= $_SESSION["perso"]->degats() ?> point(s) de dégats
            </p>

            <form action="index.php?action=frapper" method="post">
                <input type="text" value="" name="id"/>
                <input type="submit" value="frapper" name="frapper"/>
            </form>

            <form action="index.php?action=deconnexion" method="post">
                <input type="submit" value="deconnexion" name="deconnexion"/>
            </form>
        <?php } ?>


    </body>
</html>