<?php 
namespace Oc\Projet_4\Models;

class Manager 
{
    public function __construct()
    {
        try
        {
            $this->_db = new \PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('erreur : '.$e->getMessage());
        } 
    }
}