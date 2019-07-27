<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
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
		<div class="pagination">
			<?php foreach ($chapters as $chapter) { ?>
				<div class="chapters_published">
					<h3><?= $chapter->getTitle() ?></h3><br />
					<a href="index.php?action=chapter&id=<?= $chapter->getId() ?>">Lire</a>
				</div>
			<?php } ?>

			<?php for ($i = 1; $i <= $nbPage; $i++) {
				if ($i == $cPage) {
					echo " $i /";
				} else {
					echo " <a href=\"index.php?p=$i\">$i</a> /";
				}
			} ?>
		</div>
	</section>
</body>

<footer class="footer">
	<?php include("footer.php"); ?>
</footer>

</html>