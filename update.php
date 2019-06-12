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
// get the elements from a chapter 
$req = $db->prepare('SELECT * FROM chapters WHERE id= :id AND title= :title AND content= :content ');
$req->execute([
    "id" => $_GET['id'],
    "title" => $_GET['title'],
    "content" => $_GET['content']
]);
$chapter = $req->fetch();
var_dump($chapter)

/*$req_modif = $db->prepare('UPDATE chapters SET  title= "nvtitle", content= "nvcontent" WHERE id= "id" ');
$req_modif->execute([
    'nvtitle' => $_GET['title'],
    'nvcontent' => $_GET['content'],
    'id' => $_GET['id']
]);
$req_modif->execute();*/
?>

<!DOCTYPE html>
<html lang="fr">
<form class="chapter_form" action="update.php" method="post">
    <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title" value="<?php $chapter['title'] ?>"><br/>
    <textarea name="content" id="content" cols="30" rows="10" value="<?= $chapter['content'] ?>"></textarea><br/>
    <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
</form>  
</html> 