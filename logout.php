<!-- <-PROJET 4 OC: BLOG DE JEAN FORTEROCHE-> -->
<?php
session_start();

// delete connexion for user admin
unset($_SESSION['user']);
session_destroy();
header ('location: login.php');
exit();
