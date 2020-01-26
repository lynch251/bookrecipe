<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=recette;charset=utf8','root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	die('Erreur: '.$e->getMessage());
	die(print_r($bdd->errorInfo()));
}