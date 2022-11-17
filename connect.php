<?php

$user='root';
$password='';

try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=controle_php;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

?>