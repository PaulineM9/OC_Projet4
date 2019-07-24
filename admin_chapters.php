<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();
require "models/entities/Chapters.php";
require "models/managers/ChaptersManager.php";
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

// get a chapter and modifie it
$chapterManager = new ChaptersManager($db); // on créé un nouvel objet et on lui passe la fonction get
$chapter = $chapterManager->getList(); // $chapter devient alors un objet

// $req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
// $req->execute();

// get all informations about new chapters 
if (isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) // condition pour s'assurer que $_POST n'est pas vide
    {   // d'abord on créé un objet chapter et on renvoie des données
        $chapters = new Chapters([
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ]);
        $chaptersManager = new ChaptersManager(); //$chaptersManager est notre objet
        $chaptersManager->addChapter($chapters); // on appelle la focntion addChapter avec pour argument l'objet $chapter

        header('Location: admin_chapters.php'); 
        exit(); 
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>

    <body>
        <header class="index_header">
            <a href="index.php"><h1>Accueil</h1></a>
            <a href="logout.php"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin">
            <h1>Chapitres</h1>
            <a class="nav_home_chapters" href="admin.php"><img src="images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_comments" href="admin_comments.php"><img src="images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>
        </section>
        <section class="admin_chapters">
            <h1>Ecrire un nouveau chapitre</h1>
            <form class="chapter_form" action="admin_chapters.php" method="post">
                <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title"><br/>
                <textarea class="chapter" id="mytextarea" name="content" placeholder="Votre texte" id="content" cols="30" rows="10"></textarea><br/>
                <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
            </form>    
        </section>
        <section class="edit_chapters">                       
            <?php if (!empty($chapter))
            {
                foreach ($chapter as $cle => $elements)
                { ?>
                <div class="chapters_published">
                <h3><?= $elements->getTitle() ?></h3><br/>
                <p><?= $elements->getContent() ?></p>
                <a href="update.php?id=<?= $elements->getId() ?>">Modifier le texte</a>
                </div>   
                <?php } 
            } ?>               
        </section>
    </body>
</html>
    