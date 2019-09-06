<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../public/stylesheet.css" />
	<!-- <link rel="icon" type="image/png" href=""/> -->
	<title>Le blog de Jean Forteroche.</title>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="icon" type="image/png" href="images/icons8-train-ticket-96.png" /><!-- favicon -->

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

	<!-- Fontawesome Icones -->
	<script src="https://kit.fontawesome.com/504cd5157f.js"></script>

	<!-- TinyMCE -->
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: "#mytextarea",
			language_url: "./public/langs/fr_FR.js",
			language: "fr_FR",
		});
	</script>

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
	<header>
		<a href="index.php?action=home"><h1>Accueil</h1></a>
		<a href="index.php?action=login"><h3>Connexion<h3></a> 
	</header>
	
	<section class="error">
        <p>Oups! Une erreur s'est produite.</p><br/>
        <p><?= $message_error ?></p>
	</section>
</body>

<footer>
	<div class="footer_infos">
		<div class="footer_icone">
			<a href="index.php?action=home"><img src="../public/images/icons8-train-ticket-96.png" alt="icone_train" /></a>
		</div>
		<div class="contact">
			<h1>Contact</h1>
			<p>Jean Forteroche</p>
			<a href="mailto:jeanforteroche@forteroche.com">Mail: jeanforteroche@forteroche.com</a>
		</div>
		<div class="social_media">
			<img class="icone_f" src="../public/images/icons8-facebook-96.png" alt="icone_facebook" />
			<img class="icone_t" src="../public/images/icons8-black-twitter-logo-96.png" alt="icone_twitter" />
			<img class="icone_i" src="../public/images/icons8-instagram-filled-100.png" alt="icone_instagram" />
		</div>
	</div>
	<div class="copyright">
		<p>Copyright. Tous droits réservés Jean Forteroche 2019 / Projet d'étude OpenclassRooms / Création Super!</p>
	</div>
</footer>

</html>