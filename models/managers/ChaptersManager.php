<?php
class ChaptersManager
{
    private $_db;

    public function __construct()
    {
        // $this->setDb($db);
        try
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('erreur : '.$e->getMessage());
        } 
    }

    public function get($id) 
    {
        $req = $this->_db->prepare('SELECT * FROM chapters WHERE id = ?');
        $req->execute([
            $id
        ]);
        $chapter = $req->fetch(); // récupère les données et les stocke dans la variable $chapter sous forme de tableau clé / valeur qui récupère de la bdd
        
        return new Chapters($chapter);  
    }

    public function getList()
    {
        $list = [];

        $req = $this->_db->prepare('SELECT * FROM chapters ORDER BY id');
        $data = $req->execute();
        
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        // var_dump($data);  => contient bien tous les chapitres
        // die();
        {
            $list = new Chapters($data);
            // var_dump($data);  => ne contient plus que le premier chapitre
            // die();
        }
        // var_dump($list);  => ne contient plus que le dernier chapitre
        // die();
        return $list;
    }

    public function addChapter(Chapters $chapter) // la fonction addChapter() reçoit un objet 'Chapters' 
    {
        $req = $this->_db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute([
            $chapter->title(), // récupère le getter 'title'
            $chapter->content(), // récupère le getter 'content'
        ]);
    }

    public function update(Chapters $chapter)
    {
        $req_modif = $this->_db->prepare('UPDATE chapters SET title = :title, content = :content  WHERE id = :id');
        $req_modif->execute([
            'id' => $chapter->id(),
            'title'  => $chapter->title(),
            'content' => $chapter->content()
        ]);
    }

    // public function setDb(PDO $db)
    // {
    //     $this->_db = $db;
    // }

}