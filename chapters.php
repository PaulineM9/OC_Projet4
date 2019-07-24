<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
require "models/entities/Chapters.php";
require "models/managers/ChaptersManager.php";
require "models/entities/Comments.php";
require "models/managers/CommentsManager.php";
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
} 

// get all informations about chapters 
$chapterManager = new ChaptersManager(); // on créé un nouvel objet et on lui passe la fonction get
$chapter = $chapterManager->get($_GET['id']); // $chapter devient alors un objet

// create a comment
if (isset($_POST['pseudo']) && isset($_POST['comment']) && !empty($_POST['pseudo']) && !empty($_POST['comment'])) // condition pour s'assurer que $_POST n'est pas vide
{   
    $comment = new Comments([
        $_GET['id'], 
        $_POST['pseudo'], 
        $_POST['comment'],
        ]); 
    $commentManager = new CommentsManager();
    $commentManager->getAdd($comment);

    header('Location: chapters.php?id='.$_GET['id']);  
    exit(); 
}

// get all comments about a chapter clicked 
$commentChapter = new CommentsManager();
$commentedChapter = $commentChapter->getChapterComment($_GET['id']);

// signal a comment to the administration
if (isset($_GET['signaled']))
{
    $comments = new Comments([
        'idComment' => $_GET['idComment']
    ]);
    $commentSignal = new CommentsManager();
    $commentSignal->getSignal($_GET['idComment']);

    $message = "Ce commentaire a été signalé à l'administrateur";
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>
    <body>
        <header class="index_header">
            <?php include("header.php"); ?>
        </header>
        <section class="chapters_header">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Jean Forteroche</h2>
            <img class="scroll_white_chapters" src="images/icons8-scroll-down-wht.png" alt="icone_scroll" />
        </section>
        <section class="edit_chapters">      
                <div class="chapters_published">                   
                    <h3><?= $chapter->getTitle() ?></h3><br/>
                    <p><?= $chapter->getContent() ?></p><br/>
                    <hr>
                    <p class="comments_publication">Commentaires: </p>
                    <?php if (!empty($commentedChapter))
                    { foreach ($commentedChapter as $cle => $elements) { ?>
                        <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?> (<a href="chapters.php?id=<?= $chapter->getId() ?>&idComment=<?= $elements->getId() ?>&signaled" class="signal">Signaler</a>): </p><br/> 
                        <p class="comment_published"><?= $elements->getComment() ?><br />
                        <div class="signal_message">
                            <?php if(isset($_GET['signaled'])) { echo $message; } ?>   
                        </div>  
                        <?php }
                    } ?>   
                </div>
            <div class="comments">
                <h4>Laissez-moi vos commentaires</h4>
                <form class="comments_form" action="chapters.php?id=<?= $_GET['id'] ?>" method="post">
                    <input class="pseudo" type="text" name="pseudo" placeholder="Pseudo" id="pseudo"><br/>
                    <textarea class="comment" name="comment" placeholder="Votre commentaire" id="comment" cols="30" rows="10"></textarea><br/>
                    <input class="submit" type="submit" name="submit" placeholder="Envoyer" id="submit"><br/>
                </form>                
            </div>
        </section>
    </body> 
    <footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>
