<?php
namespace Oc\Projet_4\Models;

class ChaptersManager extends Manager
{
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
        {
            $list [] = new Chapters($data);
        }
        // var_dump($list);  
        return $list;
    }

    public function addChapter(Chapters $chapter) // la fonction addChapter() reçoit un objet 'Chapters' 
    {
        $req = $this->_db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute([
            $chapter->getTitle(), // récupère le getter 'title'
            $chapter->getContent(), // récupère le getter 'content'
        ]);
    }

    public function update(Chapters $chapter)
    {
        $req_modif = $this->_db->prepare('UPDATE chapters SET title = :title, content = :content  WHERE id = :id');
        $req_modif->execute([
            'id' => $chapter->getId(),
            'title'  => $chapter->getTitle(),
            'content' => $chapter->getContent()     
        ]);
    }

    public function getCount()
    {
        $req = $this->_db->prepare('SELECT COUNT(id) as nbArt FROM chapters');
        $req->execute();
        $data = $req->fetch();

        return $data['nbArt'];
    }

    public function getChapterForPagination($perPage2, $perPage)
    {
        $list = [];

        $req = $this->_db->prepare('SELECT * FROM chapters LIMIT '.$perPage2.', '.$perPage.'');
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $list [] = new Chapters($data);
        }
        
        return $list;
    }
}
