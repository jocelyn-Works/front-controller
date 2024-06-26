<?php

$page = isset($_GET['page']) ? $_GET['page'] : '';

switch ($page) {
    case '':
    case 'home':
        include './view/home.php';
        break;
    case 'hobby':
        include './view/hobby.php';
        break;
    case 'contact':
        include './view/contact.php';
        break;
    default:
        include './view/404.php';
        break;
}


?>




