<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="mainblock">
    
    <table>

        <tr class="grey">
            <th>ID</th>
            <th>Titre</th>
            <th>Synopsis</th>
            <th>Auteur</th>
            <th>Date de parution</th>
            <th>Actions</th>
        </tr>

        <?php

            $liste = $bdd->prepare("SELECT livres.*, auteur.nom FROM livres INNER JOIN auteur ON livres.id_auteur = auteur.id");
            $liste->execute();
            $liste = $liste->fetchAll();

            foreach ($liste as $livre) { 
                
                $date = $livre['date_parution'];

                $theDate = new DateTime($date);
                $theDate = $theDate->format('d/m/Y');
                
                ?>

                <tr>
                    <td><?= $livre['id'] ?></td>
                    <td><?= $livre['titre'] ?></td>
                    <td><?= $livre['synopsis'] ?></td>
                    <td><?= $livre['nom'] ?></td>
                    <td><?= $theDate ?></td>
                    <td>
                        <?php $urlUp='update.php?id='.$livre['id'];
                              $urlDel='delete.php?id='.$livre['id'] ?>
            
                        <a href=<?= $urlUp ?>><img src="edit.png" width="30" class="edit" id= <?php $livre['id'] ?>></a>
                        <a href=<?= $urlDel ?>><img src="delete.png" width="30" class="delete" id= <?php $livre['id'] ?>></a>
                    </td>
                </tr>

   <?php    }

        ?>

    </table>
    
    <a href="create.php"><button>+ Ajouter un livre</button></a>

</div>

</body>
</html>