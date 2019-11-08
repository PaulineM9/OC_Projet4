<?php 
namespace Oc\Projet_4\Models;

class User
{
    private $_id,
            $_identifiant,
            $_email,
            $_password;

    public function __construct(array $data) // il reçoit un tableau en argument
    {
        $this->hydrate($data); // on envoie un tableau à la méthode hydrate()
    }

    public function hydrate(array $data) // méthode qui envoie nos données stockées ds le tableau aux setters
    {
        if (isset($data['id'])) // vérifie que la donnée existe
        {
            $this->setId($data['id']); // si elle existe on envoie la données vers le setter qui prend en paramètre l'élément de la bd
        }

        if (isset($data['identifiant']))
        {
            $this->setIdentifiant($data['identifiant']);
        }

        if (isset($data['email']))
        {
            $this->setEmail($data['email']);
        }

        if (isset($data['password']))
        {
            $this->setPassword($data['password']);
        }
    }

// GETTERS: Permet seulement de retourner la variable privée
    public function getId() 
    {
        return $this->_id;
    }

    public function getIdentifiant()
    {
        return $this->_identifiant;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

// SETTERS
    public function setId($id) // le setter reçoit les infos de la function hydrate et envoie l'id à la variable privée $_id
    {
        $id = (int)$id;
        if ($id > 0)
        {
            $this->_id = $id; // la variable privée = l'élément selectionné
        }
    }

    public function setIdentifiant($identifiant)
    {
        $this->_identifiant = htmlspecialchars($identifiant);
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }
}