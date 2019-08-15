<?php 
class Manager 
{
    protected function dbConnect()
    {
        try {
            $db = new PDO(
                'mysql:host=localhost;dbname=projet_4;charset=utf8',
                'root',
                'root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {
            die('erreur : ' . $e->getMessage());
        }
    }
}