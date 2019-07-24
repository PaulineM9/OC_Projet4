<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
require "models/entities/Chapters.php";
require "models/managers/ChaptersManager.php";
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
} 

// get all the chapters
$chapterManager = new ChaptersManager($db); // on créé un nouvel objet et on lui passe la fonction get
$chapter = $chapterManager->getList(); // $chapter devient alors un objet

// $req = $db->prepare('SELECT * FROM chapters ORDER BY id');
// $req->execute();

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
		<section class="index_title">
			<h1>Billet simple pour l'Alaska</h1>
			<h2>Jean Forteroche</h2>
			<h3>Acteur et Ecrivain</h3>
			<img class="scroll_black" src="images/icons8-scroll-down-blk.png" alt="icone_scroll" />
		</section>
		<section class="index_chapters">
			<div class="chapters_published">
				<h3><?= $chapter->getTitle() ?></h3><br/>
				<a href="chapters.php?id=<?= $chapter->getId() ?>">Lire</a>
			</div>
		</section>
	</body>

	<footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>
