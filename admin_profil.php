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

// get new inscription for administration
if (isset($_POST['submit']))
{
    $validation = true;

    $identifiantAdmin = htmlspecialchars($_POST['identifiant']);
    $emailAdmin = htmlspecialchars($_POST['email']);
    $passwordAdmin = htmlspecialchars($_POST['password']);
    $checkPassword =htmlspecialchars($_POST['check_password']);
    $regex_letters = preg_match("#[A-Z]{1,}#", $passwordAdmin);
    $regex_specials = preg_match("#[\#\.\!\$\(\)\[\]\{\}\?\+\=\*\|]{1}#", $passwordAdmin);

    $pass_hache = password_hash($passwordAdmin, PASSWORD_DEFAULT);
    $pass_hacheCheck = password_hash($checkPassword, PASSWORD_DEFAULT);

    $req = $db->prepare('SELECT * FROM user');
    $req->execute();
    $data = $req->fetch();
    // var_dump($data);
    // die();

    if (strlen($passwordAdmin) < 6)
    {
        $validation = false;
        $errorPassword = "Mot de passe < 6 caractères";
    }
    
    if ($passwordAdmin != $checkPassword)
    {
        $validation = false;
        $errorPwCheck = "Les mots de passe ne correspondent pas.";
    }

    if (!$regex_specials OR !$regex_letters) 
    {
        $validation = false;
        $errorRegex = "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial.";
    }

    if ($validation)
    {
        $req = $db->prepare('UPDATE user SET identifiant= :identifiant, email= :email, password= :password WHERE id = :id');
        $req->execute(array(
            'id' => $_GET['id'],
            'identifiant'  => $_POST['identifiant'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ));
        // header('Location: admin_profil.php?id='.$_GET['id']);  
        // exit(); 
        $acountOk = "Vos informations personnelles ont bien été modifiées.";  
        $newConnexion = 'Merci de vous reconnecter <a href="login.php">Nouvelle connexion</a>';
        unset($_SESSION['user']);
        session_destroy();
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
            <a href="index.php"><h1>Accueil</h1></a>
            <a href="logout.php"><h3>Déconnexion<h3></a> 
        </header>
        <section class="header_admin_profil">
            <h1>Modifier mes informations personnelles</h1>
            <a class="nav_home_chapters_profil" href="admin.php"><img src="images/icons8-cabane-en-rondins-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_chapters_profil" href="admin_chapters.php"><img src="images/icons8-typewriter-with-paper-48.png" alt="icone_chat_bubble" /></a>
            <a class="nav_comments_profil" href="admin_comments.php"><img src="images/icons8-chat-bubble-64.png" alt="icone_chat_bubble" /></a>
        </section>
        <?php if (!isset($_GET['modif'])) { ?>
        <section class="profil">
            <h2 class="infos_profil">Mes informations personnelles</h2>
            <p>mon identifiant: <?php echo $_SESSION['identifiant'] ?></p><br/>
            <p>mon adresse mail: <?php echo $_SESSION['email'] ?></p>
        </section>
        <div class="modif">
            <a href="admin_profil.php?id=<?= $_GET['id'] ?>&modif">Modifier mon profil ou mon mot de passe</a>
            <?php } ?>
            <?php if (isset($_GET['modif'])) { ?>
            <form class="sign_in_modif" action="admin_profil.php?id=<?= $_GET['id']?>&modif" method="post">
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