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
            <h1>Bonjour <?= $_SESSION['identifiant'] ?>, bienvenue dans votre espace personnel</h1>
        </section>
        <section class="navigation">
            <div class="navigation_icones">
                <a class="chapters_link" href="index.php?action=admin_chapter"><img src="images/icons8-typewriter-with-paper-48.png" alt="icone_typewriter" /></a>
                <a class="comments_link" href="admin_comments.php"><img src="images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>    
                <a class="profil_link" href="admin_profil.php"><img src="images/icons8-account-64.png" alt="icone_profil" /></a>    

            </div>
            <div class="navigation_title">
                <a class="chapters_link_title" href="admin_chapters.php">Ecrire un nouveau chapitre</a><br/>
                <a class="comments_link_title" href="admin_comments.php">Gérer les commentaires</a>
                <a class="profil_link_title" href="admin_profil.php?id=<?= $_SESSION['user'] ?>">Modifier mes informations personnelles</a>
            </div>      
        </section> 
    </body>
</html>


