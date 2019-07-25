<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
require "models/entities/User.php";
require "models/managers/UserManager.php";
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

// connexion to the administration space
if (!empty($_POST))
{
    $validation = true;
    
    $profil = new User([
        'identifiant' => $_POST['identifiant']
    ]);
    $profilAcount = new UserManager();
    $profilManager = $profilAcount->getConnect($profil);
    
    $passwordCorrect = password_verify($_POST['password'], $profilManager->getPassword());

    if ($profilManager === false) 
    {
        $validation = false;
    } 

    if (!$passwordCorrect) 
    {
        $validation = false;  
    } 

    if ($validation === true)
    {
        $_SESSION['user'] = $profilManager->getId();
        $_SESSION['identifiant'] = $profilManager->getIdentifiant();
        $_SESSION['email'] = $profilManager->getEmail();
        $_SESSION['password'] = $profilManager->getPassword();
        // $_SESSION['user'] = $data['id'];
        // $_SESSION['identifiant'] = $data['identifiant'];
        // $_SESSION['email'] = $data['email'];
        // $_SESSION['password'] = $data['password'];

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
            <p class="error_message"><?php if (isset($messageErreur)){ echo $messageErreur; } ?></p>
            <form class="connexion_form" action="login.php" method="post"> 
                <input class="identifiant" type="text" name="identifiant" placeholder="Identifiant" id="identifiant"><br/>
                <input class="password" type="password" name="password" placeholder="Mot de passe" id="password"><br/>
                <input class="connexion" type="submit" name="connexion" placeholder="Connexion" id="connexion"><br/>
            </form>
        </section>
    </body>

    <footer class="footer">
		<?php include("footer.php"); ?>
	</footer>
</html>