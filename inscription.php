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
    $submitAdmin = htmlspecialchars($_POST['submit']);

    $pass_hache = password_hash($passwordAdmin, PASSWORD_DEFAULT);
    $pass_hacheCheck = password_hash($checkPassword, PASSWORD_DEFAULT);

    $req = $db->prepare('INSERT INTO connexion (identifiant, email, password, check_password) VALUES (?,?,?,?)');
    $data = $req->execute(array($_POST['identifiant'], $_POST['email'], $pass_hache, $pass_hacheCheck));

    if ($data === false)
    {
        $validation = false;
    }

    if (strlen($passwordAdmin) < 6)
    {
        $validation = false;
    }

    if ($passwordAdmin != $checkPassword)
    {
        $validation = false;
    }

    // if ($data('id') > '1') // permet à un seul utilisateur de créer un compte admin
    // {
    //     $validation = false; 
    // }

    if (preg_match("#[A-Z]{1,}#", $passwordAdmin) && preg_match("#[\#\.\!\$\(\)\[\]\{\}\?\+\=\*\|]{1}#", $passwordAdmin) && $validation === true)
    {
        $acountOk = "Votre compte administrateur a été créé avec succès.";
        header('Location: inscription.php');
        exit();
    } else {
        $errorMessage = "Vérifiez que tous les champs sont bien renseignés.";
    }
}
// if (isset($_POST['submit']))
// {
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
//             $messageCompteOk = "Votre compte administrateur a été créé avec succès.";
//         } else {
//             $messageErreur = "Un des champs n'est pas renseigné correctement.";
//         }
//     } 
// }
// TODO: NE PERMETTRE QU'UNE SEULE CONNEXION ADMINISTRATEUR OU CONFIRMER L'INSCRIPTION PAR MAIL PR EVITER D'AUTRES CONNEXIONS
// TODO: NE PAS AUTORISER LA CRÉATION D'UN COMPTE AVEC UNE ADRESSE MAIL EXISTANTE

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
            <p>Le mot de passe doit contenir plus de 6 caractères dont au moins une majuscule et un caractère spécial.</p>
            <p id="message_erreur"><?php if (isset($errorMessage)){ echo $errorMessage; } ?></p>
            <p id="message_ok"><?php if (isset($acountOk)){ echo $acountOk; } ?></p>
    </body>
</html>