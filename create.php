<?php
require 'connect.php';

$valid = true;

$titre = $synopsis = $auteur = $date = "";
$titreErr = $synopsisErr = $auteurErr = $dateErr = $formErr = "";

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

        $titre = addslashes($_POST['titre']);
        $synopsis = addslashes($_POST['synopsis']);
        $auteur = addslashes($_POST['auteur']);
        $date = $_POST['date'];
        $sql = "INSERT INTO livres (titre, synopsis, id_auteur, date_parution) 
                VALUES ('$titre', '$synopsis', '$auteur', '$date')";
        //echo $sql;
        //$sql = addslashes($sql);
        //$sql = $bdd->prepare($sql);
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
    <title>Ajouter</title>
</head>
<body>

<div id="mainblock">

    <form method="post">

        <input type="text" name="titre" placeholder="Titre">
        <span class="error"><?= $titreErr ?></span><br>

        <label for="synopsis">Synopsis : </label>
        <textarea name="synopsis" id="synopsis" cols="30" rows="10" placeholder="Synopsis"></textarea>
        <!--<input type="text" name="synopsis" placeholder="Synopsis" id="synopsis">-->
        <span class="error"><?= $synopsisErr ?></span><br>

        <!--<input type="text" name="auteur" placeholder="Auteur">-->

        <label for="auteur">Sélectionnez un auteur</label>
        <select name="auteur">
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

        <input type="date" name="date">
        <span class="error"><?= $dateErr ?></span><br>

        <div id="bouton">

            <span class="error"><?= $formErr ?></span>
            <input type="submit" name="submit" value="Ajouter le Livre" >

            <a href="list.php"><input type="button" value="Retour à la liste"></a>
         </div>

    </form>

</div>
    
</body>
</html>