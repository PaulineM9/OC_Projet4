<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
require "models/entities/Comments.php";
require "models/managers/CommentsManager.php";

session_start();
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

// join tables for getting all comments and chapter title 
$commentManager = new CommentsManager();
$comment = $commentManager->getList();

// get all comments with signal alert
$commentSigManager = new CommentsManager();
$commentSignaled = $commentSigManager->getListSignaled();

// delete comments 
if (isset($_GET['delete']))
{
    $commentsDelete = new Comments([
        'id' => $_GET['id']
    ]);
    $commentsManager = new CommentsManager();
    $commentsManager->getDelete($commentsDelete);

    header('Location: admin_comments.php');
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
            <h1>Gérer les commentaires</h1>
            <a class="nav_home_comments" href="admin.php"><img src="images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_chapters" href="admin_chapters.php"><img src="images/icons8-typewriter-with-paper-48.png" alt="icone_chat_bubble" /></a>
        </section>
        <section class="admin_comments">
            <div class="show_all_comments">
                <h2>Tous les commentaires</h2>
                <?php if (!empty($comment))
                    { foreach ($comment as $cle => $elements)
                        { ?>
                            <p class="title_ref"><?= $elements->getIdChapter() ?></p><br/><!-- à remplacer par le titre du chapitre-->
                            <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?>:
                            <a href="admin_comments.php?id=<?= $elements->getId() ?>&delete"><i class="fas fa-times"></i></a></p><br/>
                            <p class="show_comment"><?= $elements->getComment() ?><br/>
                            <hr class="inser_comment">
                        <?php }
                    } ?>
            </div>
            
            <div class="comments_signal">
                <h2>Commentaires signalés</h2>
                <?php if (!empty($commentSignaled))
                    { foreach ($commentSignaled as $cle => $elements)
                        { ?>
                    <!-- <p class="title_ref"><?= $chapter['title'] ?></p> --><!-- à remplacer par le titre du chapitre-->
                    <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?>:
                    <a href="admin_comments.php?id=<?= $elements->getId() ?>&delete"><i class="fas fa-times"></i></a></p><br/>
                    <p class="show_comment"><?= $elements->getComment() ?><br/>
                    <hr class="inser_comment">
                    <?php } 
                } ?>
            </div>
        </section>
    </body>
</html>