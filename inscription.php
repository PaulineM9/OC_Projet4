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


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>
    <body>
        <div class="inscription_title">
            <a class="accueil" href="index.php"><img src="images/icons8-train-ticket-96.png" alt="icone_train" /></a>
            <h1>INSCRIPTION ADMINISTRATEUR</h1>
        </div>
        <div class="inscription_form">
            <form class="sign_in" action="inscription.php" method="post">
                <input class="identifiant_admin" type="text" name="identifiant" size=30 placeholder="Identifiant" id="identifiant"><br/>
                <input class="password_admin" type="password" name="password" placeholder="password" id="password"><br/>
                <input class="check_password" type="password" name="check_password" placeholder="Vérifiez votre mot de passe" id="check_password"><br/>
                <input class="submit_admin" type="submit" name="submit" placeholder="Envoyer" id="submit"><br/>
            </form>
    </body>
</html>