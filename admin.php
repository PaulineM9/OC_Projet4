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
//var_dump($_POST); // permet de vérifier que le post contient des infos
// recover all informations about new chapters 
if (!empty($_POST) ) // condition pour s'assurer que $_POST n'est pas vide
    {   
        $req = $db->prepare('INSERT INTO chapters (title, content) VALUES ( ?, ?)');
        $req->execute(array($_POST['title'], $_POST['content']));
        // header('Location: admin.php'); 
        // exit(); 
    }
$req = $db->prepare('SELECT * FROM chapters ORDER BY id DESC');
$req->execute();

//recover all comments
$req_2 = $db->prepare('SELECT id_chapter, pseudo, comment, date_comment, DATE_FORMAT (date_comment, "%d/%m/%Y à %Hh%imin%ss") AS date_creation_comment FROM comments ORDER BY date_comment DESC');
$req_2->execute();
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
            <a href="admin.php"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin">
            <h1>Bonjour Jean, bienvenue dans votre espace personnel</h1>
        </section>
        <section class="admin_chapters">
            <h1>Ecrire un nouveau chapitre</h1>
            <form class="chapter_form" action="admin.php" method="post">
                <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title"><br/>
                <textarea class="chapter" name="content" placeholder="Votre texte" id="content" cols="30" rows="10"></textarea><br/>
                <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
            </form>    
        </section>
        <section class="edit_chapters">             
            <?php while ($chapters = $req->fetch()){ ?>
                <div class="chapters_published">
                    <h3><?= htmlspecialchars($chapters['title']) ?></h3><br/>
                    <p><?= htmlspecialchars($chapters['content']) ?></p>
                    <a href="update.php?id=<?= $chapters['id'] ?>&amp;title=<?= $chapters['title'] ?>&amp;content=<?= $chapters['content'] ?>">Modifier le texte</a>
                </div>
            <?php } ?>
        </section>
        <section class="admin_comments">
            <h1>Gérer les commentaires</h1>
             <div class="show_all_comments">
                <?php while ($comments = $req_2->fetch()){ ?>
                    <p>[ <?= htmlspecialchars($comments['date_comment']) ?> ] Par <?= htmlspecialchars($comments['pseudo']) ?>: </p><br/>
                    <p class="show_comment"><?= htmlspecialchars($comments['comment']) ?><br/>
                    <p>Supprimer ce commentaire</p>
                    <hr class="inser_comment">
                <?php } ?>
            </div>
        </section>
        <div class="deconnexion">
        <a href="accueil.php"><h4>Déconnexion<h4></a>
        </div>
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