<?php 

class User
{
    private $_id,
            $_identifiant,
            $_email,
            $_password;

    public function __construct(array $data) 
    {
        $this->hydrate($data); 
    }

    public function hydrate(array $data) 
    {
        if (isset($data['id'])) 
        {
            $this->setId($data['id']); 
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

// GETTERS: 
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
    public function setId($id) 
    {
        $id = (int)$id;
        if ($id > 0)
        {
            $this->_id = $id; 
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