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
// get chapter title and content 
$req = $db->prepare('SELECT * FROM chapters WHERE id= :id');
$req->execute([
    "id" => $_GET['id']
]);
$chapter = $req->fetch();
var_dump($chapter);

// add changes on a chapter
if (isset($_POST['title']) OR isset($_POST['content'])) 
{
    $req_modif = $db->prepare('UPDATE chapters SET title = :title, content = :content  WHERE id = :id ');
    $req_modif->execute(array(
        'id' => $_GET['id'],
        'title'  => $_POST['title'],
        'content' => $_POST['content']
    ));
    // header('Location: admin_chapters.php?id='.$_GET['id']);  
    // exit(); 
}
?>

<!DOCTYPE html>
<html lang="fr">
<form class="chapter_form" action="update.php?id=<?= $_GET['id'] ?>" method="post">
    <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title" value="<?= $chapter['title'] ?>"><br/>
    <textarea name="content" id="content" cols="30" rows="10" ><?= $chapter['content'] ?></textarea><br/>
    <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
</form>  
</html> 