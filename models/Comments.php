<?php

class Comments
{
    private $_id,
            $_id_chapter,
            $_pseudo,
            $_comment,
            $_date_comment,
            $_signaled;

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
        if (isset($data['id_chapter']))
        {
            $this->setIdChapter($data['id_chapter']);
        }
        if (isset($data['pseudo']))
        {
            $this->setPseudo($data['pseudo']);
        }
        if (isset($data['comment']))
        {
            $this->setComment($data['comment']);
        }
        if (isset($data['date_comment']))
        {
            $this->setDateComment($data['date_comment']);
        }
        if (isset($data['signaled']))
        {
            $this->setSignaled($data['signaled']);
        }
    }

// GETTERS: 
    public function getId() 
    {
        return $this->_id;
    }

    public function getIdChapter() 
    {
        return $this->_id_chapter;
    }

    public function getPseudo() 
    {
        return $this->_pseudo;
    }

    public function getComment()
    {
        return $this->_comment;
    }

    public function getDateComment()
    {
        return $this->_date_comment;
    }

    public function getSignaled()
    {
        return $this->_signaled;
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

    public function setIdChapter($id_chapter)
    {
        $id_chapter = (int)$id_chapter;
        if ($id_chapter > 0)
        {
            $this->_id_chapter = $id_chapter; 
        }
    }

    public function setPseudo($pseudo)
    {
        $this->_pseudo = htmlspecialchars($pseudo);
    }

    public function setComment($comment)
    {
        if (is_string($comment))
        {
            $this->_comment = htmlspecialchars($comment);
        }
    }

    public function setDateComment($date_comment)
    {
            $this->_date_comment = $date_comment;
    }

    public function setSignaled($signaled)
    {
        if ($signaled == 0 OR $signaled == 1)
        {
            $this->_signaled = $signaled;
        }
    }
}