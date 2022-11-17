<?php
require 'connect.php';

$id_livre = $_GET['id'];

$liste = $bdd->prepare("SELECT titre FROM livres WHERE livres.id = '$id_livre'");
$liste->execute();
$liste = $liste->fetch();

if (isset($_POST['confirm'])) {
    $bdd->exec("DELETE * FROM livres WHERE id = '$id_livre'");
}

//if (isset($_POST['cancel'])) {
//    header('Location:list.php');
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression</title>
</head>
<body>

    <?php echo 'Êtes vous sûr de vouloir supprimer '.$liste['titre']. ' ?'; ?>
    <form method="post">
        <div id="bouton">
            <input type="button" name="confirm" value="Oui">
            <a href="list.php"><input type="button" name="cancel" value="Non"></a>
        </div>

    </form>
    
</body>
</html>