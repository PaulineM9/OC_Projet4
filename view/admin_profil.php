<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("view/head.php"); ?>
    </head>

    <body>
        <header class="index_header">
            <a href="index.php?action=home"><h1>Accueil</h1></a>
            <a href="index.php?action=logout"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin_profil">
            <h1>Modifier mes informations personnelles</h1>
            <a class="nav_home_chapters_profil" href="index.php?action=admin"><img src="public/images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_chapters_profil" href="index.php?action=admin_chapters"><img src="public/images/icons8-typewriter-with-paper-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_comments_profil" href="index.php?action=admin_comments"><img src="public/images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>
        </section>
        <?php if (!isset($_GET['modif'])) { ?>
        <section class="profil">
            <h2 class="infos_profil">Mes informations personnelles</h2>
            <p>mon identifiant: <?php echo $_SESSION['identifiant'] ?></p><br/>
            <p>mon adresse mail: <?php echo $_SESSION['email'] ?></p>
        </section>
        <div class="modif">
            <a href="index.php?action=admin_profil&id=<?= $_GET['id'] ?>&modif">Modifier mon profil ou mon mot de passe</a>
            <?php } ?>
            <?php if (isset($_GET['modif'])) { ?>
            <form class="sign_in_modif" action="index.php?action=admin_profil&id=<?= $_GET['id']?>&modif" method="post">
                <input class="identifiant_admin" type="text" name="identifiant"  placeholder="Identifiant" id="identifiant" value="<?= $_SESSION['identifiant'] ?>"><br/>
                <input class="email_admin" type="email" name="email" placeholder="Votre email" id="email" value="<?= $_SESSION['email'] ?>"><br/>
                <input class="password_admin" type="password" name="password" placeholder="Nouveau mot de passe" id="password"><br/>
                <input class="check_password" type="password" name="check_password" placeholder="Confirmation du mot de passe" id="check_password"><br/>
                <input class="submit_admin" type="submit" name="submit" value="Inscription" id="submit"><br/>
            </form>
            <p id="pw_message">Le mot de passe doit contenir plus de 6 caractères <br/> dont au moins une majuscule et un caractère spécial.</p>
            <p id="message_error"><?php if (isset($errorPassword))  { echo $errorPassword; } ?></p>
            <p id="message_error"><?php if (isset($errorPwCheck))  { echo $errorPwCheck; } ?></p>
            <p id="message_error"><?php if (isset($errorRegex))  { echo $errorRegex; } ?></p>
            <p id="message_ok_new"><?php if (isset($acountOk)){ echo $acountOk; echo $newConnexion; } ?></p>
            <?php } ?>
        </div>
    </body>
</html>