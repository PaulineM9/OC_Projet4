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

// get all informations about admin
$req = $db->prepare('SELECT * FROM user');
$req->execute();

?>

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
        <section class="profil">
            <h1 class="infos_profil">Mes informations personnelles</h1>
            <?php while ($data = $req->fetch()){ ?>
                <p>Identifiant: <?= htmlspecialchars($data['identifiant']) ?></p>
                <p>Email: <?= htmlspecialchars($data['email']) ?></p>
            <?php } ?>
        </section>
        <div class="modif">
            <a href="update_profil.php">Modifier mon profil ou mon mot de passe</a>
        </div>
    </body>
</html>