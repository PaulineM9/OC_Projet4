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

// get inscription for administration
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

    if ($data != false)
    {
        $validation = false;
        $errorData = "Un compte administrateur a déjà été créé. Merci de contacter l'auteur.";
    }

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

    if ($regex_letters = false OR $regex_specials = false) // ne fonctionne pas ?
    {
        $validation = false;
        $errorRegex = "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial.";
    }

    if ($validation)
    {
        $req = $db->prepare('INSERT INTO user (identifiant, email, password) VALUES (?,?,?)');
        $req->execute(array(
            $identifiantAdmin, 
            $emailAdmin, 
            $pass_hache
        ));
        $acountOk = "Votre compte administrateur a bien été  créé.";  
    }
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
            <h1>Créez votre compte administrateur</h1>
            <form class="sign_in" action="inscription.php" method="post">
                <input class="identifiant_admin" type="text" name="identifiant" size=60 placeholder="Identifiant" id="identifiant"><br/>
                <input class="email_admin" type="email" name="email" placeholder="Votre email" id="email"><br/>
                <input class="password_admin" type="password" name="password" placeholder="password" id="password"><br/>
                <input class="check_password" type="password" name="check_password" placeholder="Confirmation du mot de passe" id="check_password"><br/>
                <input class="submit_admin" type="submit" name="submit" value="Inscription" id="submit"><br/>
            </form>
            <p>Le mot de passe doit contenir plus de 6 caractères <br/> dont au moins une majuscule et un caractère spécial.</p>
            <p id="message_erreur"><?php if (isset($errorData))  { echo $errorData; } ?></p>
            <p id="message_erreur"><?php if (isset($errorPassword))  { echo $errorPassword; } ?></p>
            <p id="message_erreur"><?php if (isset($errorPwCheck))  { echo $errorPwCheck; } ?></p>
            <p id="message_erreur"><?php if (isset($errorRegex))  { echo $errorRegex; } ?></p>
            <p id="message_ok"><?php if (isset($acountOk)){ echo $acountOk; } ?></p>
    </body>
</html>




<!-- 
// $submitAdmin = htmlspecialchars($_POST['submit']);

// if (isset($_POST['submit']))
// {
//     $req = $db->prepare('SELECT * FROM connexion');
//     $req->execute();
//     $data = $req->fetch();
//     var_dump($data);
//     die();

//     $identifiantAdmin = htmlspecialchars($_POST['identifiant']);
//     $emailAdmin = htmlspecialchars($_POST['email']);
//     $passwordAdmin = htmlspecialchars($_POST['password']);
//     $checkPassword =htmlspecialchars($_POST['check_password']); 
//     $submitAdmin = htmlspecialchars($_POST['submit']);

//     if ($identifiantAdmin && $emailAdmin && $passwordAdmin && $checkPassword)
//     { 
//         if (strlen($passwordAdmin) >= 6 && $passwordAdmin === $checkPassword && preg_match("#[A-Z]{1,}#", $passwordAdmin) && preg_match("#[\#\.\!\$\(\)\[\]\{\}\?\+\=\*\|]{1}#", $passwordAdmin)) 
//         {   
//             $pass_hache = password_hash($passwordAdmin, PASSWORD_DEFAULT);
//             $pass_hacheCheck = password_hash($checkPassword, PASSWORD_DEFAULT);
//             $req = $db->prepare('INSERT INTO connexion (identifiant, email, password, check_password) VALUES (?,?,?,?)');
//             $req->execute(array($_POST['identifiant'], $_POST['email'], $pass_hache, $pass_hacheCheck));
//             $acountOk = "Votre compte administrateur a été créé avec succès.";
//         } else {
//             $errorMessage = "Veuillez vérifier que tous les champs sont bien renseignés.";
//         } 
//     } 
// } -->