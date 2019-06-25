<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();

// delete connexion for user admin
$_SESSION['user'] = $data['id'];
session_destroy();
header ('location: login.php');
exit();

// delete cookies for the session
// setcookie('identifiant','');
// unset($_COOKIE['identifiant']);
// setcookie('password', '');
// unset($_COOKIE['password']);
?>