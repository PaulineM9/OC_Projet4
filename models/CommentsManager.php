<?php 
require_once("models/Manager.php");

class CommentsManager extends Manager
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

    public function getList() 
    {
        $list = [];

        $req = $this->_db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments ORDER BY date_comment DESC');
        $req->execute();

        $req_join = $this->_db->prepare('SELECT * FROM chapters, comments WHERE chapters.id=comments.id_chapter ORDER BY date_comment DESC');
        $req_join->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC))        
        {
            while ($data = $req_join->fetch(PDO::FETCH_ASSOC))           
            {
                $list [] = $data;  
            }
        }
        return $list;
    }

    public function getAdd($comment)
    {
        $req = $this->_db->prepare('INSERT INTO comments (id_chapter, pseudo, comment, date_comment, signaled) VALUES (?, ?, ?, NOW(), 0)');
        $req->execute([
            $_GET['id'], 
            $_POST['pseudo'],
            $_POST['comment']
        ]); 
    }

    public function getSignal($comments)
    {
        $req_signal = $this->_db->prepare('UPDATE comments SET signaled = 1 WHERE id = :idChapter');
        $req_signal->execute([
            'idChapter' => $comments->getId()
        ]);
    } 

    public function getDelete($commentsDelete)
    {
        $req_delete = $this->_db->prepare('DELETE FROM comments WHERE id = :id');
        $req_delete->execute([
            'id' => $commentsDelete->getId() 
        ]);
    }

    public function getListSignaled()
    {
        $list = [];

        $req = $this->_db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE signaled = 1 ORDER BY date_comment DESC');
        $req->execute();

        $req_join = $this->_db->prepare('SELECT * FROM chapters, comments WHERE chapters.id=comments.id_chapter AND signaled = 1 ORDER BY date_comment DESC');
        $req_join->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC))        
        {
            while ($data = $req_join->fetch(PDO::FETCH_ASSOC))           
            {
                $list [] = $data;  
            }
        }
        return $list;
    }

    public function getChapterComment()
    {
        $list = [];

        $req = $this->_db->prepare('SELECT id, pseudo, comment, date_comment, signaled, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE id_chapter= ? ORDER BY date_comment DESC LIMIT 0, 5');
        $req->execute(array(
            $_GET['id']
        ));

        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $list [] = new Comments($data); 
        }
        
        return $list;
    }
}