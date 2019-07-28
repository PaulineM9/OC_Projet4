<?php
session_start();
require("controllers/frontend.php");
require("controllers/backend.php");
require("models/entities/Chapters.php");
require("models/managers/ChaptersManager.php");
require("models/entities/Comments.php");
require("models/managers/CommentsManager.php");
require("models/entities/User.php");
require("models/managers/UserManager.php");
require("models/entities/User.php");
require("models/managers/UserManager.php");

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'chapter')
    {
        chapter();
    } elseif ($_GET['action'] == 'login')
    {
        login();
    } elseif ($_GET['action'] == 'admin')
    {
        admin();
    } elseif ($_GET['action'] == 'admin_chapter')
    {
        adminChapter();
    }

} else {
    home();
}