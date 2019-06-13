<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
// if  (isset($_POST['identifiant']) && isset($_POST['password']) && !empty($_POST['identifiant']) && !empty($_POST['password'])) 
    if($_POST['identifiant'] == 'Jean_Forteroche' && $_POST['password'] == 'blog_alaska')
        { 
           include("admin.php");
        }
        else 
        {
            include("connexion_error.php");
        }
?>