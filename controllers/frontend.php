<?php
function home()
{   
    $chapterManager = new ChaptersManager();

    // count chapters into the table
    $nbChapter = $chapterManager->getCount();
    $nbArt = $nbChapter;
    $perPage = 4;
    $nbPage = ceil($nbArt / $perPage);

    // pagination
    if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) {
        $cPage = $_GET['p'];
    } else {
        $cPage = 1;
    }

    $perPage2 = (($cPage - 1) * $perPage);

    // chapter for pagination
    $chapters = $chapterManager->getChapterForPagination($perPage2, $perPage);

    ob_start();
    include('views/frontend/indexView.php');
    $content = ob_get_clean();
    require("views/frontend/template.php");
}

function chapter()
{
    // get all informations about chapters 
    $chapterManager = new ChaptersManager(); // on créé un nouvel objet et on lui passe la fonction get
    $chapter = $chapterManager->get($_GET['id']); // $chapter devient alors un objet

    // create a comment
    if (isset($_POST['pseudo']) && isset($_POST['comment']) && !empty($_POST['pseudo']) && !empty($_POST['comment'])) // condition pour s'assurer que $_POST n'est pas vide
    {
        $comment = new Comments([
            $_GET['id'],
            $_POST['pseudo'],
            $_POST['comment'],
        ]);
        $commentChapter = new CommentsManager();
        $commentChapter->getAdd($comment);
        
        header('Location: index.php?action=chapter&id=' . $_GET['id']);
        exit();
    }

    // get all comments about a chapter clicked 
    $commentChapter = new CommentsManager();
    $commentedChapter = $commentChapter->getChapterComment($_GET['id']);
    $_SESSION['flash']['danger'] = '';

    // signal a comment to the administration
    if (isset($_GET['signaled'])) {
        $comments = new Comments([
            'id' => $_GET['idComment']
        ]);
        $commentChapter->getSignal($comments);
        $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . 'Ce commentaire a été signalé à l\'administrateur' . '<br/>';    
    }
    ob_start();
    include('views/frontend/chapterView.php');
    $content = ob_get_clean();
    require("views/frontend/template.php");
}

function login()
{
    // connexion to the administration space
    if (!empty($_POST)) {
        $validation = true;

        $profil = new User([
            'identifiant' => $_POST['identifiant']
        ]);
// var_dump($profil); 
// die();
        $profilAcount = new UserManager();
        $profilManager = $profilAcount->getConnect($profil);
// var_dump($profilManager);  
// die();
        $passwordCorrect = password_verify($_POST['password'], $profilManager->getPassword());
// var_dump($passwordCorrect); 
// die();
        $_SESSION['flash']['danger'] = '';

        if (!$profilManager) {
            $validation = false;
        }

        if ($passwordCorrect === false) {
            $validation = false;
        }

        if ($validation === true) {
            $_SESSION['user'] = $profilManager->getId();
            $_SESSION['identifiant'] = $profilManager->getIdentifiant();
            $_SESSION['email'] = $profilManager->getEmail();
            $_SESSION['password'] = $profilManager->getPassword();

            header('Location: index.php?action=admin');
            exit();
        } else {
            $_SESSION['flash']['danger'] = $_SESSION['flash']['danger'] . "L'identifiant ou le mot de passe est incorrect." . '<br/>';
        }
    } 

    ob_start();
    include('views/frontend/loginView.php');  
    $content = ob_get_clean();
    require("views/frontend/template.php");
}

