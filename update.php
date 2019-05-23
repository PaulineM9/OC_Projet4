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
// récupère le chapitre pour modification
$req = $db->prepare('SELECT * FROM chapters WHERE id= :id AND title= :title AND chapter= :chapter ');
$req->execute([
    "id" => $_GET['id'],
    "title" => $_GET['title'],
    "chapter" => $_GET['chapter']
]);
$chapter = $req->fetch();
// var_dump($chapter)

?>

<!DOCTYPE html>
<html lang="fr">
<form class="chapter_form" action="admin.php" method="post">
    <input class="number_chapter" type="text" name="number_chapter" placeholder="Numéro du chapitre" id="number_chapter" value="<?= $chapter["number_chapter"] ?>"><br/>
    <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title" value="<?= $chapter["title"] ?>"><br/>
    <textarea name="chapter" id="chapter" cols="30" rows="10" value="<?= $chapter["chapter"] ?>"></textarea><br/>
    <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
</form>  
</html> 