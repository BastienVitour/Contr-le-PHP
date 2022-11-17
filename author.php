<?php
require 'connect.php';

$valid = true;

$author = $authorErr = "";

if (!empty($_POST['author'])) {

    $author = $_POST['author'];

    $check_author = $bdd->prepare("SELECT nom FROM auteur WHERE nom = ?");
    $check_author->execute([$author]);
    $check_author = $check_author->fetch();

    if ($check_author) {
        $authorErr = 'Cet auteur existe déjà';
        $valid = false;
    }
    else {
        $bdd->exec("INSERT INTO auteur (id, nom) VALUES (NULL, '$author')");
        header('Location:create.php');
    }
}
else {
    $valid = false;
    $authorErr = 'L\'auteur ne peut pas être vide';
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajout auteur</title>
</head>
<body>

<div id="mainblock">
 
    <form method="post">
        
        <input type="text" name="author" placeholder="Auteur" id="">
        <span class="error"><?= $authorErr ?></span>

        <input type="submit" name="submit" value="Ajouter">

    </form>

</div>
    
</body>
</html>