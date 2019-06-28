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
// var_dump($article);

// create a comment
// var_dump($_POST);
if (isset($_POST['pseudo']) && isset($_POST['comment']) && !empty($_POST['pseudo']) && !empty($_POST['comment'])) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req = $db->prepare('INSERT INTO comments ( id_chapter, pseudo, comment, date_comment) VALUES (?, ?, ?, NOW())');
        $req->execute(array(
            $_GET['id'], 
            $_POST['pseudo'], 
            $_POST['comment']
        )); 
        header('Location: chapters.php?id='.$_GET['id']);  
        exit(); 
    }

// get all comments about a chapter clicked 
$req = $db->prepare('SELECT pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments WHERE id_chapter= ? ORDER BY date_comment DESC LIMIT 0, 5');
$req->execute(array(
    $id
));
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
                    
                    <?php while ($comments = $req->fetch()){ ?> <!-- tant que la variable qui contient les données les récupère on affiche... -->
                        <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>: (<a href="chapters.php?signalement=ok&id=<?= $id ?>" class="signal">Signaler</a>)</p><br/> 
                        <p class="comment_published"><?= htmlspecialchars($comments['comment']) ?>
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