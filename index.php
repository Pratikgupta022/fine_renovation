<?php
include 'Controllers/Controllers.php';
include 'Models/Constants.php';

session_start();

$controllerObj = new Controllers();
$action = isset($_GET['action']) ? $_GET['action'] : '';

// print_r($_SERVER['REQUEST_URI']);
// $requestURI = $_SERVER['REQUEST_URI'];

// $BaseURL = strpos('/fine_renovation',$requestURI);

$isAdmin = (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['isAdmin'] > 0) ? $_SESSION['loggedUser']['isAdmin'] : 0;

if($action == 'index'){
    $controllerObj->homePage();
}
elseif($action == 'register'){
    $controllerObj->registerWorkers();
}
elseif($action == 'login'){
    $controllerObj->loginPage();
}
elseif($action == 'logout'){
    $controllerObj->logoutUser();
}
elseif($action == 'edit-w'){
    if(isset($_GET['id']) && $isAdmin == 1){
        $controllerObj->editWorkerData($_GET['id']);
    }
    $controllerObj->editWorkerData();
}
elseif($action == 'delete'){
    if(isset($_GET['id']) && $isAdmin == 1){
        $controllerObj->deleteWorkerData($_GET['id']);
    }
}
else{
    $controllerObj->homePage();
}
