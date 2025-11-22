<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=reparationbd','root', '');
    //echo "Connexion établie avec succès!!";
}
catch (PDOException $e)
{
	die('Erreur : ' . $e->getMessage());
}
?>