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
		<meta charset="utf-8" />
		<link rel="stylesheet" href="stylesheet.css" />
		<!-- <link rel="icon" type="image/png" href=""/> -->
		<title>Le blog de Jean Forteroche</title>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<link href="" rel="stylesheet" />
		<link rel="icon" type="image/png" href="images/icons8-train-ticket-96.png" /><!-- favicon -->

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet"> 

		<!-- Twitter Card data -->
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:creator" content="@PaulineM9">

		<!-- FB Open Graph data -->
		<meta property="og:title" content="Le blog de Jean Forteroche" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="www.projet-4.pauline-superweb.com" />
		<meta property="og:image" content="" />
		<meta property="og:description" content="Le blog de Jean Forteroche" />

		<meta name="description" content="Le blog de Jean Forteroche" />
		<meta name="keywords" content="Le blog de Jean Forteroche, blog, ecrivain" />
		<meta name="author" content="PaulineM9" />
		<style>
			a {
				text-decoration: none;
				color: #ffc226;
			}
		</style>
	</head>

	<body>
		<header class="index_header">
			<a href="index.php"><h1>Accueil</h1></a>
			<a href="admin.php"><h3>Connexion<h3></a> <!-- À MODIFIER QD LA PAGE CONNEXION SERA ACTIVE -->
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
		<div class="footer_infos">
			<div class="footer_icone">
				<img src="images/icons8-train-ticket-96.png" alt="icone_train" />
			</div>
			<div class="contact">
				<h1>Contact</h1>
				<p>Jean Forteroche</p>
				<a href="mailto:jeanforteroche@forteroche.com">Mail: jeanforteroche@forteroche.com</a>
			</div>
			<div class="social_media">
				<img class="icone_f" src="images/icons8-facebook-96.png" alt="icone_facebook" />
				<img class="icone_t" src="images/icons8-black-twitter-logo-96.png" alt="icone_twitter" />
				<img class="icone_i" src="images/icons8-instagram-filled-100.png" alt="icone_instagram" />
			</div>
		</div>
		<div class="copyright">
			<p>Copyright. Tous droits réservés Jean Forteroche / Projet d'étude OpenclassRooms / Création Super!</p>
		</div>
	</footer>
</html>
