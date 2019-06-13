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
        <div class="insscription_title">
            <h1>Inscription administrateur</h1>
        </div>
        <div class="inscription_form">
            <form class="sign_in" action="inscription.php" method="post">
                <input class="identifiant" type="text" name="identifiant" placeholder="Identifiant" id="identifiant"><br/>
                <input class="password" type="password" name="password" placeholder="password" id="password"><br/>
                <input class="check_password" type="password" name="check_password" placeholder="Vérifiez votre mot de passe" id="check_password"><br/>
                <input class="submit" type="submit" name="submit" placeholder="Envoyer" id="submit"><br/>
            </form>
    </body>