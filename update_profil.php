<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();
if (!isset($_SESSION['user']))
{
    header('Location: login.php');
    exit();
}
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
} 

// get all infos about profil
$req = $db->prepare('SELECT * FROM user');
$req->execute();
$data = $req->fetch();
var_dump($data);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php include("head.php"); ?>
    </head>

    <body>
        <!-- <header class="index_header">
            <a href="index.php"><h1>Accueil</h1></a>
            <a href="logout.php"><h3>Déconnexion<h3></a> 
        </header> -->
        <section class="update_profil">           
            <form action="update_profil.php" method="post" class="profil_infos">
                <input type="text" class="update_identifiant" name="identifiant" placeholder="Identifiant" value="<?php $data['identifiant'] ?>">
                <input type="text" class="update_email" name="email" placeholder="Email" value="<?php $data['email'] ?>">
                <input type="password" class="update_password" name="password" placeholder="Nouveau mot de passe" value="<?php $data['password'] ?>">
                <input type="submit" class="submit" value="Envoyer">
            </form>
        </section>

        </body>
</html>