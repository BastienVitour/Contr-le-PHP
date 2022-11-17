<?php
require 'connect.php';

$id_livre = $_GET['id'];

$valid = true;

$titre = $synopsis = $auteur = $date = "";
$titreErr = $synopsisErr = $auteurErr = $dateErr = $formErr = "";

$liste = $bdd->prepare("SELECT livres.*, auteur.nom FROM livres INNER JOIN auteur ON livres.id_auteur = auteur.id WHERE livres.id = '$id_livre'");
$liste->execute();
$liste = $liste->fetchAll();

//On vérifie si le titre est valide
if (empty($_POST['titre'])) {
    $valid = false;
    $titreErr = 'Le titre ne peut pas être vide';
}

//On vérifie si le synopsis est valide
if (empty($_POST['synopsis'])) {
    $valid = false;
    $synopsisErr = 'Le synopsis ne peut pas être vide';
}

//On vérifie si le nom de l'auteur est valide
if (empty($_POST['auteur'])) {
    //$valid = false;
    //$auteurErr = 'L\'auteur ne peut pas être vide';
}

//On vérifie si la date est valide
if (empty($_POST['date'])) {
    $valid = false;
    $dateErr = 'La date ne peut pas être vide';
}

if (isset($_POST['submit'])) {
    if ($valid) {

        $titre = $_POST['titre'];
        $synopsis = $_POST['synopsis'];
        $auteur = $_POST['auteur'];
        $date = $_POST['date'];

        //$bdd->exec("INSERT INTO livres (id, titre, synopsis, id_auteur, date_parution) 
        //            VALUES (NULL, '$titre', '$synopsis', '$auteur', '$date')");

        $sql = "UPDATE livres SET titre = '$titre', synopsis='$synopsis', id_auteur='$auteur', date_parution='$date' WHERE id = '$id_livre'";
        $sql = $bdd->prepare($sql);
        $bdd->exec($sql);

        header('Location:list.php');
        
    }
    else {
        $formErr = 'Veuillez remplir tous les champs';
        $valid = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<div id="mainblock">

    <form method="post">

    <?php 
    foreach ($liste as $livre) { ?>

    <input type="text" name="titre" placeholder="Titre" value="<?= $livre['titre'] ?>">
        <span class="error"><?= $titreErr ?></span><br>

        <label for="synopsis">Synopsis : </label>
        <textarea name="synopsis" id="synopsis" cols="30" rows="10" placeholder="Synopsis"><?= $livre['synopsis'] ?></textarea>
        <!--<input type="text" name="synopsis" placeholder="Synopsis" id="synopsis" value=" //$livre['synopsis'] ?>">-->
        <span class="error"><?= $synopsisErr ?></span><br>

        <!--<input type="text" name="auteur" placeholder="Auteur">-->

        <label for="auteur">Sélectionnez un auteur</label>
        <select name="auteur" value="<?= $livre['id'] ?>">
            <?php 
            $auteur_select = $bdd->prepare("SELECT * FROM auteur");
            $auteur_select->execute();
            $auteur_select = $auteur_select->fetchAll();

            foreach ($auteur_select as $auteurs) { ?>
                <option value="<?php echo $auteurs['id'] ?>"><?= $auteurs['nom'] ?></option>
       <?php    } ?>
            
        </select>
        <span class="error"><?= $auteurErr ?></span><br>

        <button id="add_author"><a href="author.php">+ Ajouter un auteur</a></button>

        <input type="date" name="date" value="<?= $livre['date_parution'] ?>">
        <span class="error"><?= $dateErr ?></span><br>

        <div id="boutons">
            <span class="error"><?= $formErr ?></span>
            <input type="submit" name="submit" value="Mettre à jour l'entrée" >
            <a href="list.php"><input type="button" value="Retour à la liste"></a>
        </div>

    </form>

    <?php } ?>

</div>
    
</body>
</html>