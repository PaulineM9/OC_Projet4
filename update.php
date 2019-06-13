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
$req = $db->prepare('SELECT * FROM chapters WHERE id= :id AND title= :title AND content= :content ');
$req->execute([
    "id" => $_GET['id'],
    "title" => $_GET['title'],
    "content" => $_GET['content']
]);
$chapter = $req->fetch();
var_dump($chapter);

// add changes on a chapter
// à mettre dans un if avec les conditions de protection des données
$req_modif = $db->prepare('UPDATE chapters SET title= :newtitle, content= :newcontent ');
$req_modif->execute(array(
    'newtitle'  => $_POST['title'],
    'newcontent' => $_POST['content']
));
while ($données = $req_modif->fetch());

?>

<!DOCTYPE html>
<html lang="fr">
<form class="chapter_form" action="admin.php" method="post">
    <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title" value="<?= $chapter["title"] ?>"><br/>
    <textarea name="content" id="content" cols="30" rows="10" value="<?= $chapter["content"] ?>"></textarea><br/>
    <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
</form>  
</html> 