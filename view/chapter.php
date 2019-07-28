<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("view/head.php"); ?>
    </head>
    <body>
        <header class="index_header">
            <?php include("header.php"); ?>
        </header>
        <section class="chapters_header">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Jean Forteroche</h2>
            <img class="scroll_white_chapters" src="public/images/icons8-scroll-down-wht.png" alt="icone_scroll" />
        </section>
        <section class="edit_chapters">      
                <div class="chapters_published">                   
                    <h3><?= $chapter->getTitle() ?></h3><br/>
                    <p><?= $chapter->getContent() ?></p><br/>
                    <hr>
                    <p class="comments_publication">Commentaires: </p>
                    <?php if (!empty($commentedChapter))
                    { foreach ($commentedChapter as $cle => $elements) { ?>
                        <p>[ <?= $elements->getDateComment() ?> ] Par <?= $elements->getPseudo() ?> (<a href="index.php?action=chapter&id=<?= $chapter->getId() ?>&idComment=<?= $elements->getId() ?>&signaled" class="signal">Signaler</a>): </p><br/> 
                        <p class="comment_published"><?= $elements->getComment() ?><br />
                        <div class="signal_message">
                            <?php if(isset($_GET['signaled'])) { echo $message; } ?>   
                        </div>  
                        <?php }
                    } ?>   
                </div>
            <div class="comments">
                <h4>Laissez-moi vos commentaires</h4>
                <form class="comments_form" action="index.php?action=chapter&id=<?= $_GET['id'] ?>" method="post">
                    <input class="pseudo" type="text" name="pseudo" placeholder="Pseudo" id="pseudo"><br/>
                    <textarea class="comment" name="comment" placeholder="Votre commentaire" id="comment" cols="30" rows="10"></textarea><br/>
                    <input class="submit" type="submit" name="submit" placeholder="Envoyer" id="submit"><br/>
                </form>                
            </div>
        </section>
    </body> 
    <footer class="footer">
		<?php include("view/footer.php"); ?>
	</footer>
</html>
