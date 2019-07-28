<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("view/head.php"); ?>
    </head> 
    <body>
        <div class="inscription_title">
            <a class="accueil" href="index.php?action=home"><img src="public/images/icons8-train-ticket-96.png" alt="icone_train" /></a>
            <h1>INSCRIPTION ADMINISTRATEUR</h1>
        </div>
        <div class="inscription_form">
            <h1>Créez votre compte administrateur</h1>
            <form class="sign_in" action="index.php?action=inscription" method="post">
                <input class="identifiant_admin" type="text" name="identifiant" size=60 placeholder="Identifiant" id="identifiant"><br/>
                <input class="email_admin" type="email" name="email" placeholder="Votre email" id="email"><br/>
                <input class="password_admin" type="password" name="password" placeholder="Mot de passe" id="password"><br/>
                <input class="check_password" type="password" name="check_password" placeholder="Confirmation du mot de passe" id="check_password"><br/>
                <input class="submit_admin" type="submit" name="submit" value="Inscription" id="submit"><br/>
            </form>
            <p>Le mot de passe doit contenir plus de 6 caractères <br/> dont au moins une majuscule et un caractère spécial.</p>
            <p id="message_erreur"><?php if (isset($errorData))  { echo $errorData; } ?></p>
            <p id="message_erreur"><?php if (isset($errorPassword))  { echo $errorPassword; } ?></p>
            <p id="message_erreur"><?php if (isset($errorPwCheck))  { echo $errorPwCheck; } ?></p>
            <p id="message_erreur"><?php if (isset($errorRegex))  { echo $errorRegex; } ?></p>
            <p id="message_ok"><?php if (isset($acountOk)){ echo $acountOk; } ?></p>
        </div>
    </body>
</html>