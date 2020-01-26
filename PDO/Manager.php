<?php
class Manager
{
function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=db778069675.hosting-data.io;dbname=db778069675;charset=utf8','dbo778069675', 'Empireearth258??');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
}
