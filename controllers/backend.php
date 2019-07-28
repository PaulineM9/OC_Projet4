<?php
function admin()
{
    $sessionConnect = sessionConnect();
    $db = dbConnectBack();

    include("view/admin.php");
}

function admin_chapters()
{
    $sessionConnect = sessionConnect();
    $db = dbConnectBack();

    // get a chapter and modifie it
    $chapterManager = new ChaptersManager(); // on créé un nouvel objet et on lui passe la fonction get: objet qui contient des méyhodes
    $chapter = $chapterManager->getList(); // $chapter devient alors un objet

    // get all informations about new chapters 
    if (isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) // condition pour s'assurer que $_POST n'est pas vide
    {   // d'abord on créé un objet chapter et on renvoie des données
        $chapters = new Chapters([
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ]);
        $chapterManager->addChapter($chapters); // on appelle la focntion addChapter avec pour argument l'objet $chapter

        header('Location: index.php?action=admin_chapters');
        exit();
    }

    include("view/admin_chapters.php");
}

function admin_comments()
{
    $sessionConnect = sessionConnect();
    $db = dbConnectBack();

    // join tables for getting all comments and chapter title 
    $commentManager = new CommentsManager();
    $comment = $commentManager->getList();

    // get all comments with signal alert
    $commentSigManager = new CommentsManager();
    $commentSignaled = $commentSigManager->getListSignaled();

    // delete comments 
    if (isset($_GET['delete'])) {
        $commentsDelete = new Comments([
            'id' => $_GET['id']
        ]);
        $commentsManager = new CommentsManager();
        $commentsManager->getDelete($commentsDelete);

        header('Location: index.php?action=admin_comments');
        exit();
    }

    include("view/admin_comments.php");
}

function admin_profil()
{
    $sessionConnect = sessionConnect();
    $db = dbConnectBack();

    // get new inscription for administration
    if (isset($_POST['submit'])) {
        $validation = true;

        $identifiantAdmin = htmlspecialchars($_POST['identifiant']);
        $emailAdmin = htmlspecialchars($_POST['email']);
        $passwordAdmin = htmlspecialchars($_POST['password']);
        $checkPassword = htmlspecialchars($_POST['check_password']);
        $regex_letters = preg_match("#[A-Z]{1,}#", $passwordAdmin);
        $regex_specials = preg_match("#[\#\.\!\$\(\)\[\]\{\}\?\+\=\*\|]{1}#", $passwordAdmin);

        $acount = new UserManager();
        $newAcount = $acount->get();

        if (strlen($passwordAdmin) < 6) {
            $validation = false;
            $errorPassword = "Mot de passe < 6 caractères";
        }

        if ($passwordAdmin != $checkPassword) {
            $validation = false;
            $errorPwCheck = "Les mots de passe ne correspondent pas.";
        }

        if (!$regex_specials or !$regex_letters) {
            $validation = false;
            $errorRegex = "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial.";
        }

        if ($validation) {
            $pass_hache = password_hash($passwordAdmin, PASSWORD_DEFAULT);

            $profil = new User([
                'id' => $_GET['id'],
                'identifiant'  => $_POST['identifiant'],
                'email' => $_POST['email'],
                'password' => $pass_hache
            ]);
            $profilAcount = new UserManager();
            $profilAcount->getChanges($profil);

            $acountOk = "Vos informations personnelles ont bien été modifiées.";
            $newConnexion = ' Merci de vous reconnecter: <a href="login.php" style="text-decoration: underline;" >Nouvelle connexion</a>';
            unset($_SESSION['user']);
            session_destroy();
        }
    }

    include("view/admin_profil.php");
}

function inscription()
{
    $db = dbConnectBack();

    // get inscription for administration
    if (isset($_POST['submit'])) {
        $validation = true;

        $identifiantAdmin = htmlspecialchars($_POST['identifiant']);
        $emailAdmin = htmlspecialchars($_POST['email']);
        $passwordAdmin = htmlspecialchars($_POST['password']);
        $checkPassword = htmlspecialchars($_POST['check_password']);
        $regex_letters = preg_match("#[A-Z]{1,}#", $passwordAdmin);
        $regex_specials = preg_match("#[\#\.\!\$\(\)\[\]\{\}\?\+\=\*\|]{1}#", $passwordAdmin);

        $acount = new UserManager();
        $newAcount = $acount->get();

        if ($newAcount != false) {
            $validation = false;
            $errorData = "Un compte administrateur a déjà été créé. Merci de contacter l'auteur.";
        }

        if (strlen($passwordAdmin) < 6) {
            $validation = false;
            $errorPassword = "Mot de passe < 6 caractères";
        }

        if ($passwordAdmin != $checkPassword) {
            $validation = false;
            $errorPwCheck = "Les mots de passe ne correspondent pas.";
        }

        if (!$regex_specials or !$regex_letters) {
            $validation = false;
            $errorRegex = "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial.";
        }

        if ($validation) {
            $pass_hache = password_hash($passwordAdmin, PASSWORD_DEFAULT);

            $profil = new User([
                'identifiant' => $identifiantAdmin,
                'email' => $emailAdmin,
                'password' => $pass_hache
            ]);

            $profilManager = new UserManager();
            $profilManager->getInscription($profil);

            $acountOk = "Votre compte administrateur a bien été  créé.";
        }
    }

    include("view/inscription.php");
}

function logout()
{
    unset($_SESSION['user']);
    session_destroy();
    header('location: index.php?action=login');
    exit();
}

function update()
{
    $sessionConnect = sessionConnect();
    $db = dbConnectBack();

    // get chapter title and content 
    $chapterManager = new ChaptersManager(); // on créé un nouvel objet et on lui passe la fonction get
    $chapter = $chapterManager->get($_GET['id']); // $chapter devient alors un objet

    // add changes on a chapter
    if (isset($_POST['title']) or isset($_POST['content'])) {
        $chapter = new Chapters([
            'id' => $_GET['id'],
            'title'  => $_POST['title'],
            'content' => $_POST['content']
        ]);
        $chapterManager = new ChaptersManager();
        $chapterManager->update($chapter);

        header('Location: index.php?action=admin_chapters&id=' . $_GET['id']);
        exit();
    }

    include("view/update.php");
}

function dbConnectBack()
{
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=projet_4;charset=utf8',
            'root',
            'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die('erreur : ' . $e->getMessage());
    }
}

function sessionConnect()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit();
    }
}