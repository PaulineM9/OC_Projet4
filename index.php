<?php
session_start();
require("controllers/frontend.php");
require("controllers/backend.php");


// TODO: GESTION DES ERREURS EN MVC
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            home();
        } elseif ($_GET['action'] == 'login') {
            login();
        } elseif ($_GET['action'] == 'admin') {
            admin();
        } elseif ($_GET['action'] == 'admin_chapters') {
            admin_chapters();
        } elseif ($_GET['action'] == 'admin_comments') {
            admin_comments();
        } elseif ($_GET['action'] == 'admin_profil') {
            admin_profil();
        } elseif ($_GET['action'] == 'inscription') {
            inscription();
        } elseif ($_GET['action'] == 'logout') {
            logout();
        } elseif ($_GET['action'] == 'update') {
            update();
        }
    } else {
        home();
    }
} catch (Exception $e) {
    echo 'erreur: ' . $e->getMessage();
}
