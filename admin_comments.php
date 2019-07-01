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

// get all comments
$req_2 = $db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments ORDER BY date_comment DESC');
$req_2->execute();

// get all comments with signal alert
// $req_3 = $db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE signal = 1 ORDER BY date_comment DESC');
// $req_3->execute();

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
            <h1>Tous les commentaires</h1>
             <div class="show_all_comments">
                <?php while ($comments = $req_2->fetch()){ ?>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>:
                    <button type="button" value="$_POST['supprimer']"><i class="fas fa-times"></i></button></p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <hr class="inser_comment">
                <?php } ?>
            </div>
            
            <!-- <div class="comments_signal">
                <h1>Commentaires signalés</h1>
                <?php while ($comments = $req_3->fetch()){ ?>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>:
                    <button type="button" value="$_POST['supprimer']"><i class="fas fa-times"></i></button></p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <hr class="inser_comment">
                <?php } ?>
            </div> -->
        </section>
    </body>
</html>