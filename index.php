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
$req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
$req->execute();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include("head.php") ?>
	</head>

	<body>
		<header class="index_header">
			<?php include("header.php") ?>
		</header>
		<section class="index_title">
			<h1>Billet simple pour l'Alaska</h1>
			<h2>Jean Forteroche</h2>
			<h3>Acteur et Ecrivain</h3>
			<img class="scroll_black" src="images/icons8-scroll-down-blk.png" alt="icone_scroll" />
		</section>
		<section class="index_chapters">
			<?php while ($chapters = $req->fetch()){ ?>
                <div class="chapters_published">
					<h3><?= htmlspecialchars($chapters['title']) ?></h3><br/>
					<a href="chapitres.php?id=<?= $chapters['id'] ?>">Lire</a>
                </div>
            <?php } ?>
		</section>
	</body>

	<footer class="footer">
		<?php include("footer.php") ?>
	</footer>
</html>
