<?php

function admin()
{
    $sessionConnect = sessionConnect();

    ob_start();
    include("views/backend/adminView.php");
    $content = ob_get_clean();
    require("views/backend/template.php");
}

function admin_chapters()
{
    $sessionConnect = sessionConnect();

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
    
    ob_start();
    include("views/backend/admin_chaptersView.php");
    $content = ob_get_clean();
    require("views/backend/template.php");
}

function admin_comments()
{
    $sessionConnect = sessionConnect();

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

    ob_start();
    include("views/backend/admin_commentsView.php");
    $content = ob_get_clean();
    require("views/backend/template.php");
}

function admin_profil()
{
    $sessionConnect = sessionConnect();

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
        $newAcount = $acount->verifyUser();
        $_SESSION['flash']['danger'] = '';

        if (strlen($passwordAdmin) < 6) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Mot de passe < 6 caractères." . '<br/>';
        }

        if ($passwordAdmin != $checkPassword) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Les mots de passe ne correspondent pas." . '<br/>';
        }

        if (!$regex_specials or !$regex_letters) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial." . '<br/>';
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

            $_SESSION['flash']['succes'] = $_SESSION['flash']['danger'] . "Vos informations personnelles ont bien été modifiées." . '<br/>';
            $_SESSION['flash']['succes'] = $_SESSION['flash']['danger'] . 'Merci de vous reconnecter:' . '<a href="login.php" style="text-decoration: underline;">Nouvelle connexion</a>' . '<br/>';
            unset($_SESSION['user']);
            session_destroy();
        }
    }

    ob_start();
    include("views/backend/admin_profilView.php");
    $content = ob_get_clean();
    require("views/backend/template.php");
}

function inscription()
{
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
        $newAcount = $acount->verifyUser();
        $_SESSION['flash']['danger'] = '';

        if ($newAcount != false) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Un compte administrateur a déjà été créé. Merci de contacter l'auteur." . '<br/>';
        }

        if (strlen($passwordAdmin) < 6) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Mot de passe < 6 caractères." . '<br/>';
        }

        if ($passwordAdmin != $checkPassword) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Les mots de passe ne correspondent pas." . '<br/>';
        }

        if (!$regex_specials or !$regex_letters) {
            $validation = false;
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "Votre mot de passe doit contenir au moins 6 caractères, 1 majuscule et 1 caractère spécial." . '<br/>';
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
            $_SESSION['flash']['succes'] = $_SESSION['flash']['danger'] . "Votre compte administrateur a bien été  créé." . '<br/>';

            header('Location: index.php?action=login');
            exit();
        }
    }

    include("inscription.php");
}

function logout()
{
    unset($_SESSION['user']);
    session_destroy();
    header('Location: index.php?action=login');
    exit();
}

function update()
{
    $sessionConnect = sessionConnect();
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

    ob_start();
    include("views/backend/updateView.php");
    $content = ob_get_clean();
    require("views/backend/template.php");
}

function sessionConnect()
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit();
    }
}