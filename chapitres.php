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
// recover all informations about chapters
// $req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
// $req->execute();

// recover all informations about new comments for every chapters
// var_dump($_POST);
if (!empty($_POST)) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req = $db->prepare('INSERT INTO comments ( id_chapter, pseudo, comment, date_comment) VALUES (?, ?, ?, NOW())');
        $req->execute(array($_POST['id_chapter'], $_POST['pseudo'], $_POST['comment']));
        header('Location: chapitres.php'); 
        exit(); 
    }
$req = $db->prepare('SELECT pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments ORDER BY date_comment DESC LIMIT 0, 5');
$req->execute();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="utf-8" />
        <link rel="stylesheet" href="stylesheet.css" />
        <!-- <link rel="icon" type="image/icons8-literature-96.png" href=""/> -->
        <title>Le blog de Jean Forteroche</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="" rel="stylesheet" />
        <link rel="icon" type="image/png" href="images/icons8-train-ticket-96.png" /><!-- favicon -->

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet"> 

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:creator" content="@PaulineM9" />

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
			<a href="connexion.php"><h3>Connexion<h3></a> 
        </header>
        <section class="chapters_header">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Jean Forteroche</h2>
            <img class="scroll_white_chapters" src="images/icons8-scroll-down-wht.png" alt="icone_scroll" />
        </section>
        <section class="edit_chapters">      
                <div class="chapters_published">
                    <h2>Chapitre <?= $_GET['number_chapter'] ?></h2><br/>
                    <h3><?= $_GET['title'] ?></h3><br/>
                    <p><?= $_GET['chapter'] ?></p><br/>
                    <hr>
                    <p class="comments_publication">Commentaires:</p>
                    <?php while ($comments = $req->fetch()){ ?>
                        <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>: </p><br/>
                        <p class="comment_published"><?= htmlspecialchars($comments['comment']) ?>
                    <?php } ?>  
                </div>
            <div class="comments">
                <h4>Laissez-moi vos commentaires</h4>
                <form class="comments_form" action="chapitres.php" method="post">
                    <input class="pseudo" type="text" name="pseudo" placeholder="Pseudo" id="pseudo"><br/>
                    <textarea class="comment" name="comment" placeholder="Votre commentaire" id="comment" cols="30" rows="10"></textarea><br/>
                    <input class="submit" type="submit" name="submit" placeholder="Envoyer" id="submit"><br/>
                </form>
            </div>
            <div class="comments_comments">
            </div>
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