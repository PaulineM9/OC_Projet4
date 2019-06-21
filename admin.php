<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();
if (!isset($_SESSION['user']))
{
    header('Location: connexion.php');
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

// get all informations about new chapters 
if (isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req = $db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute(array($_POST['title'], $_POST['content']));
        header('Location: admin.php'); 
        exit(); 
    }

$req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
$req->execute();

// get all comments
$req_2 = $db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments ORDER BY date_comment DESC');
$req_2->execute();

// TODO: deconnexion from the administration space

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>

    <body>
        <header class="index_header">
            <a href="index.php"><h1>Accueil</h1></a>
            <a href="connexion.php"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin">
            <h1>Bonjour Jean, bienvenue dans votre espace personnel</h1>
        </section>
        <section class="navigation">
            <div class="navigation_icones">
                <a class="chapters_link" href="admin_chapters.php"><img src="images/icons8-typewriter-with-paper-48.png" alt="icone_typewriter" /></a>
                <a class="comments_link" href="admin_comments.php"><img src="images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>    
            </div>
            <div class="navigation_title">
                <a class="chapters_link_title" href="admin_chapters.php">Ecrire un nouveau chapitre</a><br/>
                <a class="comments_link_title" href="admin_comments.php">Gérer les commentaires</a>
            </div>      
        </section> 
    </body>
</html>


