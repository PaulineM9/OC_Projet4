<?php
class Chapters
{
    private $_id,
            $_title,
            $_content;

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
        if (isset($data['title']))
        {
            $this->setTitle($data['title']);
        }
        if (isset($data['content']))
        {
            $this->setContent($data['content']);
        }
    }

// GETTERS: Permet seulement de retourner la variable privée
    public function getId() 
    {
        return $this->_id;
    }

    public function getTitle() 
    {
        return $this->_title;
    }

    public function getContent() 
    {
        return $this->_content;
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

    public function setTitle($title)
    {
        if (is_string($title))
        {
            // $this->_title = htmlspecialchars($title); => laisse apparaitre des balises de script html => voir plugin?
            $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content))
        {
            // $this->_content = htmlspecialchars($content); => laisse apparaitre des balises de script html => voir plugin?
            $this->_content = $content;
        }
    }
}