<?php

class ChaptersManager extends Manager
{
   public function get($id) 
    {
        $req = $this->_db->prepare('SELECT * FROM chapters WHERE id = ?');
        $req->execute([
            $id
        ]);
        $chapter = $req->fetch(); 
        
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
        return $list;
    }

    public function addChapter(Chapters $chapter) 
    {
        $req = $this->_db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute([
            $chapter->getTitle(), 
            $chapter->getContent(), 
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
