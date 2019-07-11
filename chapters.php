<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
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
$id = (int) $_GET['id']; // permet de changer la chaine en entier (integer) et de la stocker dans une variable
$req = $db->prepare('SELECT * FROM chapters WHERE id = ?');
$req->execute(array($id));
$chapter = $req->fetch(); // récupère les données et les stocke dans la variable $article

// create a comment
if (isset($_POST['pseudo']) && isset($_POST['comment']) && !empty($_POST['pseudo']) && !empty($_POST['comment'])) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req1 = $db->prepare('INSERT INTO comments (id_chapter, pseudo, comment, date_comment, signaled) VALUES (?, ?, ?, NOW(), 0)');
        $req1->execute(array(
            $_GET['id'], 
            $_POST['pseudo'], 
            $_POST['comment'],
        )); 
        header('Location: chapters.php?id='.$_GET['id']);  
        exit(); 
    }

// get all comments about a chapter clicked 
$req2 = $db->prepare('SELECT id, pseudo, comment, date_comment, signaled, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE id_chapter= ? ORDER BY date_comment DESC LIMIT 0, 5');
$req2->execute(array(
    $id
));


// comments signaled to the administration
if (isset($_GET['signaled']))
{
    $req_signal = $db->prepare('UPDATE comments SET signaled = 1 WHERE id = :idComment');
    $req_signal->execute([
        'idComment' => $_GET['idComment']
   ]);
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
                    <h3><?= $chapter['title'] ?></h3><br/>
                    <p><?= $chapter['content'] ?></p><br/>
                    <hr>
                    <p class="comments_publication">Commentaires: </p>
                    
                    <?php while ($comments = $req2->fetch()){ ?> <!-- tant que la variable qui contient les données les récupère on affiche... -->
                        <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?> (<a href="chapters.php?id=<?= $chapter['id'] ?>&idComment=<?= $comments['id'] ?>&signaled" class="signal">Signaler</a>): </p><br/> 
                        <p class="comment_published"><?= htmlspecialchars($comments['comment']) ?><br />
                        <?php if(isset($_GET['signaled'])) { echo $message; } ?>
                    <?php } ?>
                </div>
            <div class="comments">
                <h4>Laissez-moi vos commentaires</h4>
                <form class="comments_form" action="chapters.php?id=<?= $id ?>" method="post">
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
