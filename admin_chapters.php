<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
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

// get all informations about new chapters 
if (isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req = $db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute(array($_POST['title'], $_POST['content']));
        header('Location: admin_chapters.php'); 
        exit(); 
    }

$req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
$req->execute();
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
            <?php while ($chapters = $req->fetch()){ ?>
                <div class="chapters_published">
                    <h3><?= $chapters['title'] ?></h3><br/>
                    <p><?= $chapters['content'] ?></p>
                    <a href="update.php?id=<?= $chapters['id'] ?>">Modifier le texte</a>
                </div>
            <?php } ?>
        </section>
    </body>
</html>
    