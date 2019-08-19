<?php $title = 'le blog de Jean Forteroche'; ?>

<section class="header_admin">
        <h1>Bonjour <?= $_SESSION['identifiant'] ?>,<br/> bienvenue dans votre espace personnel</h1>
    </section>
    <section class="navigation">
        <div class="navigation_icones">
            <a class="chapters_link" href="index.php?action=admin_chapters"><img src="public/images/icons8-typewriter-with-paper-48.png" alt="icone_typewriter" /></a>
            <a class="comments_link" href="index.php?action=admin_comments"><img src="public/images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>
            <a class="profil_link" href="index.php?action=admin_profil"><img src="public/images/icons8-account-64.png" alt="icone_profil" /></a>

        </div>
        <div class="navigation_title">
            <a class="chapters_link_title" href="index.php?action=admin_chapters">Ecrire un nouveau chapitre</a><br />
            <a class="comments_link_title" href="index.php?action=admin_comments">Gérer les commentaires</a>
            <a class="profil_link_title" href="index.php?action=admin_profil&id=<?= $_SESSION['user'] ?>">Modifier mes informations personnelles</a>
        </div>
</section>