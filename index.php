<?php
session_start();

function AutoLoad($class)
{
    $class = str_replace('\\', '/', $class);
    $class = str_replace(__NAMESPACE__, strtolower(__NAMESPACE__), $class);
    require $class . '.php'; 
}
spl_autoload_register('AutoLoad');

// use \Oc\Projet_4\Controllers\frontend;
// use \Oc\Projet_4\Controllers\backend;
require("controllers/frontend.php");
require("controllers/backend.php");



if (isset($_GET['action'])) {
    if ($_GET['action'] == 'home') {
        home();
    } elseif ($_GET['action'] == 'chapter') {
        chapter();
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

