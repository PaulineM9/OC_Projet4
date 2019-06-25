<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
// setcookie('identifiant', $_POST['identifiant'], time() + 900, null, null, false, true);
// setcookie('password', $_POST['password'], time() + 900, null, null, false, true);

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
// get chapter title and content 
$req = $db->prepare('SELECT * FROM chapters WHERE id= :id');
$req->execute([
    "id" => $_GET['id']
]);
$chapter = $req->fetch();
// var_dump($chapter);

// add changes on a chapter
if (isset($_POST['title']) OR isset($_POST['content'])) 
{
    $req_modif = $db->prepare('UPDATE chapters SET title = :title, content = :content  WHERE id = :id');
    $req_modif->execute(array(
        'id' => $_GET['id'],
        'title'  => $_POST['title'],
        'content' => $_POST['content']
    ));
    header('Location: admin_chapters.php?id='.$_GET['id']);  
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include("head.php"); ?>
    </head>
    <section class="header_update">
        <h1>Modifier un chapitre</h1>
        <a class="nav_home_update" href="admin.php"><img src="images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
        <a class="nav_chapters" href="admin_chapters.php"><img src="images/icons8-typewriter-with-paper-48.png" alt="icone_chat_bubble" /></a>
    </section>
    <section class="change_chapter">
        <form class="chapter_form" action="update.php?id=<?= $_GET['id'] ?>" method="post">
            <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title" value="<?= $chapter['title'] ?>"><br/>
            <textarea class="chapter" id="mytextarea" name="content" id="content" cols="30" rows="10" ><?= $chapter['content'] ?></textarea><br/>
            <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
        </form>  
    </section>
</html> 