<?php

class Manager 
{
    public function __construct()
    {
        try
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=mapa8726_projet_4;charset=utf8', 'mapa8726_paulineweb', "Gaspard0415",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('erreur : '.$e->getMessage());
        } 
    }
}