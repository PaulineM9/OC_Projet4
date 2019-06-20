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
        <section class="admin_chapters">
            <h1>Ecrire un nouveau chapitre</h1>
            <form class="chapter_form" action="admin.php" method="post">
                <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title"><br/>
                <textarea class="chapter" name="content" placeholder="Votre texte" id="content" cols="30" rows="10"></textarea><br/>
                <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
            </form>    
        </section>
        <section class="edit_chapters">             
            <?php while ($chapters = $req->fetch()){ ?>
                <div class="chapters_published">
                    <h3><?= htmlspecialchars($chapters['title']) ?></h3><br/>
                    <p><?= htmlspecialchars($chapters['content']) ?></p>
                    <a href="update.php?id=<?= $chapters['id'] ?>&amp;title=<?= $chapters['title'] ?>&amp;content=<?= $chapters['content'] ?>">Modifier le texte</a>
                </div>
            <?php } ?>
        </section>
        <section class="admin_comments">
            <h1>Gérer les commentaires</h1>
             <div class="show_all_comments">
                <?php while ($comments = $req_2->fetch()){ ?>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>: <button type="button" value="$_POST['valider']"><i class="fas fa-check-double"></i></button> <button type="button" value="$_POST['supprimer']"><i class="fas fa-times"></i></button></p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <hr class="inser_comment">
                <?php } ?>
            </div>
        </section>
    </body>
    <footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>