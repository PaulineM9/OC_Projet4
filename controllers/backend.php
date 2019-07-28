<?php 
function adminChapter()
{
    if (!isset($_SESSION['user']))
    {
        header('Location: login.php');
        exit();
    }
    
    // get a chapter and modifie it
    $chapterManager = new ChaptersManager(); 
    $chapter = $chapterManager->getList(); 
    
    // get all informations about new chapters 
    if (isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) 
    {  
        $chapters = new Chapters([
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ]);
        $chaptersManager->addChapter($chapters); 
    
        header('Location: admin_chapters.php'); 
        exit(); 
    }

    include('view/admin_chapter.php');
}

function admin()
{
    if (!isset($_SESSION['user']))
{
    header('Location: login.php');
    exit();
}
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
} 

include('view/admin.php');
}
