<?php
function home()
{
    $db = dbConnect();
    
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

    include('view/home.php');
}

function chapter()
{
    $db = dbConnect();

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

    // signal a comment to the administration
    if (isset($_GET['signaled'])) {
        $comments = new Comments([
            'idComment' => $_GET['idComment']
        ]);
        $commentChapter->getSignal($comments);

        $message = "Ce commentaire a été signalé à l'administrateur";
    }
    include('view/chapter.php');
}

function login()
{
    $db = dbConnect();

    // connexion to the administration space
    if (!empty($_POST)) {
        $validation = true;

        $profil = new User([
            'identifiant' => $_POST['identifiant']
        ]);
        $profilAcount = new UserManager();
        $profilManager = $profilAcount->getConnect($profil);

        $passwordCorrect = password_verify($_POST['password'], $profilManager->getPassword());

        if ($profilManager === false) {
            $validation = false;
        }

        if (!$passwordCorrect) {
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
            $messageErreur = "L'identifiant ou le mot de passe est incorrect.";
        }
    }
    include('view/login.php');   
}

function dbConnect()
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
