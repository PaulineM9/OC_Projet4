<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();
try
{
    $db = new PDO('mysql:host=localhost;dbname=projet_4;charset=utf8', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
} 
if (!empty($_POST))
{
    $validation = true;

    $req = $db->prepare('SELECT * FROM connexion WHERE identifiant= :identifiant');
    $req->execute(array(
        'identifiant' => $_POST['identifiant']
    ));
    $data = $req->fetch();
    
    if ($data === false) 
    {
        $validation = false;
    } 

    if ($_POST['password'] != $data['password']) 
    {
        $validation = false;  
    } 

    if ($validation === true)
    {
        $_SESSION['user'] = $data['id'];
        header('Location: admin.php');
        exit();
    } else {
        $messageErreur = "L'identifiant ou le mot de passe est incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("head.php"); ?>
    </head>
    <body>
        <header class="index_header">
            <?php include("header.php"); ?>
		</header>
        <section class="connexion_header">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Jean Forteroche</h2>
            <h3>Connexion à votre espace personnel</h3>
        </section>

        <section class="connexion_container">
            <?php if (isset($messageErreur)){ echo $messageErreur; } ?>
            <form class="connexion_form" action="connexion.php" method="post"> 
                <input class="identifiant" type="text" name="identifiant" placeholder="Identifiant" id="identifiant"><br/>
                <input class="password" type="password" name="password" placeholder="motdepasse" id="password"><br/>
                <input class="connexion" type="submit" name="connexion" placeholder="Connexion" id="connexion"><br/>
            </form>
        </section>
    </body>

    <footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>