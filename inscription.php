<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="public/stylesheet.css" />
    <title>Le blog de Jean Forteroche</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/png" href="images/icons8-train-ticket-96.png" /><!-- favicon -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

    <!-- Fontawesome Icones -->
    <script src="https://kit.fontawesome.com/504cd5157f.js"></script>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: "#mytextarea",
            language_url: "./public/langs/fr_FR.js",
            language: "fr_FR",
        });
    </script>

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@PaulineM9">

    <!-- FB Open Graph data -->
    <meta property="og:title" content="Le blog de Jean Forteroche" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="www.projet-4.pauline-superweb.com" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="Le blog de Jean Forteroche" />

    <meta name="description" content="Le blog de Jean Forteroche" />
    <meta name="keywords" content="Le blog de Jean Forteroche, blog, ecrivain" />
    <meta name="author" content="PaulineM9" />
    <style>
        a {
            text-decoration: none;
            color: #ffc226;
        }
    </style>
</head>

<body>
    <div class="inscription_title">
        <a class="accueil" href="index.php?action=home"><img src="public/images/icons8-train-ticket-96.png" alt="icone_train" /></a>
        <h1>INSCRIPTION ADMINISTRATEUR</h1>
    </div>
    <div class="inscription_form">
        <h1>Créez votre compte administrateur</h1>
        <form class="sign_in" action="index.php?action=inscription" method="post">
            <input class="identifiant_admin" type="text" name="identifiant" size=60 placeholder="Identifiant" id="identifiant"><br />
            <input class="email_admin" type="email" name="email" placeholder="Votre email" id="email"><br />
            <input class="password_admin" type="password" name="password" placeholder="Mot de passe" id="password"><br />
            <input class="check_password" type="password" name="check_password" placeholder="Confirmation du mot de passe" id="check_password"><br />
            <input class="submit_admin" type="submit" name="submit" value="Inscription" id="submit"><br />
        </form>
        
        <?php if(isset($_SESSION)) { 
            include('views/flashMessages.php');
        } ?>
    </div>
</body>

</html>