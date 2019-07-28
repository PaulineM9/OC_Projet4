<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>

    <body>
        <header class="index_header">
            <a href="index.php"><h1>Accueil</h1></a>
            <a href="logout.php"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin">
            <h1>Chapitres</h1>
            <a class="nav_home_chapters" href="admin.php"><img src="images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_comments" href="admin_comments.php"><img src="images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>
        </section>
        <section class="admin_chapters">
            <h1>Ecrire un nouveau chapitre</h1>
            <form class="chapter_form" action="admin_chapters.php" method="post">
                <input class="title" type="text" name="title" placeholder="Titre du chapitre" id="title"><br/>
                <textarea class="chapter" id="mytextarea" name="content" placeholder="Votre texte" id="content" cols="30" rows="10"></textarea><br/>
                <input class="submit" type="submit" name="published" placeholder="Publier" id="published"><br/> 
            </form>    
        </section>
        <section class="edit_chapters">                       
            <?php if (!empty($chapter))
            { foreach ($chapter as $cle => $elements) { ?>
                <div class="chapters_published">
                <h3><?= $elements->getTitle() ?></h3><br/>
                <p><?= $elements->getContent() ?></p>
                <a href="update.php?id=<?= $elements->getId() ?>">Modifier le texte</a>
                </div>   
                <?php } 
            } ?>               
        </section>
    </body>
</html>
    