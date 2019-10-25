<?php $title = 'le blog de Jean Forteroche'; ?>

<section class="connexion_header">
    <h1>Billet simple pour l'Alaska</h1>
    <h2>Jean Forteroche</h2>
    <h3>Connexion à votre espace personnel</h3>
</section>

<section class="connexion_container">
    <?php if(isset($_SESSION)) { 
        include('views/flashMessages.php');
    } ?>
    <form class="connexion_form" action="index.php?action=login" method="post">
        <input class="identifiant" type="text" name="identifiant" placeholder="Identifiant" id="identifiant" required><br />
        <input class="password" type="password" name="password" placeholder="Mot de passe" id="password" required><br />
        <input class="connexion" type="submit" name="connexion" placeholder="Connexion" id="connexion"><br />
    </form>
</section>