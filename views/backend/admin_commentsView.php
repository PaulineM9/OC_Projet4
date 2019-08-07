<?php $title = 'le blog de Jean Forteroche'; ?>

<header class="index_header">
    <a href="index.php?action=home"><h1>Accueil</h1></a>
    <a href="index.php?action=logout"><h3>Déconnexion<h3></a> 
</header>
<section class="header_admin">
    <h1>Gérer les commentaires</h1>
    <a class="nav_home_comments" href="index.php?action=admin"><img src="public/images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
    <a class="nav_chapters" href="index.php?action=admin_chapters"><img src="public/images/icons8-typewriter-with-paper-48.png" alt="icone_chat_bubble" /></a>
</section>
<section class="admin_comments">
    <div class="show_all_comments">
        <h2>Tous les commentaires</h2>
        <?php if (!empty($comment))
            { foreach ($comment as $cle => $elements)
                { ?>
                    <p class="title_ref"><?= $elements->getIdChapter() ?></p><br/><!-- à remplacer par le titre du chapitre-->
                    <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?>:
                    <a href="index.php?action=admin_comments&id=<?= $elements->getId() ?>&delete"><i class="fas fa-times"></i></a></p><br/>
                    <p class="show_comment"><?= $elements->getComment() ?><br/>
                    <hr class="inser_comment">
                <?php }
            } ?>
    </div>
    
    <div class="comments_signal">
        <h2>Commentaires signalés</h2>
        <?php if (!empty($commentSignaled))
            { foreach ($commentSignaled as $cle => $elements)
                { ?>
            <!-- <p class="title_ref"><?= $chapter['title'] ?></p> --><!-- à remplacer par le titre du chapitre-->
            <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?>:
            <a href="index.php?action=admin_comments&id=<?= $elements->getId() ?>&delete"><i class="fas fa-times"></i></a></p><br/>
            <p class="show_comment"><?= $elements->getComment() ?><br/>
            <hr class="inser_comment">
            <?php } 
        } ?>
    </div>
</section>
    