<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
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
$req_join = $db->prepare('SELECT * FROM chapters, comments WHERE chapters.id=comments.id_chapter ORDER BY date_comment DESC');
$req_join->execute();

// get all comments with signal alert
$req_join2 = $db->prepare('SELECT id, id_chapter, pseudo, comment, date_comment, signaled, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE signaled = 1 ORDER BY date_comment DESC');
$req_join2->execute();

// delete comments 
if (isset($_GET['delete']))
{
    $req_delete = $db->prepare('DELETE FROM comments WHERE id = :id');
    $req_delete->execute([
        'id' => $_GET['id']
    ]);
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
                <?php while ($comments = $req_join->fetch()){ ?>
                    <p class="title_ref"><?= $comments['title'] ?></p>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>:
                    <a href="admin_comments.php?id=<?= $comments['id'] ?>&delete"><i class="fas fa-times"></i></a></p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <hr class="inser_comment">
                <?php } ?>
            </div>
            
            <div class="comments_signal">
                <h2>Commentaires signalés</h2>
                <?php while ($comments = $req_join2->fetch()) { 
                    $req = $db->prepare('SELECT title FROM chapters WHERE id = :id'); 
                    $req->execute([
                        'id' => $comments['id_chapter']
                    ]);
                    $chapter = $req->fetch();
                    ?>
                    <p class="title_ref"><?= $chapter['title'] ?></p>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>:
                    <a href="admin_comments.php?id=<?= $comments['id'] ?>&delete"><i class="fas fa-times"></i></a></p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <hr class="inser_comment">
                <?php } ?>
            </div>
        </section>
    </body>
</html>