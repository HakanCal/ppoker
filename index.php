<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

session_start();
if(isset($_POST['logout'])) {
    session_unset(); 
    session_destroy();
}
// NECESSARY FOR MVC
require_once "classes/PPokerActions.php";
require_once "classes/PPokerData.php";
require_once "views/Page.php";
require_once "views/PageInterface.php";

//Check Page request
if(isset($_REQUEST['page'])){
    $page = $_REQUEST['page'];
} else {
    $page="Homepage";
}

$pagePath = "views/".$page.".php";
// Catch wrong page requests
if(!file_exists($pagePath)){
    $page = "Homepage";
    $pagePath = "views/".$page.".php";
}

//include view from page request
require_once $pagePath;

$model = new PPokerData();
$controller = new PPokerActions($model);
$view = new $page($controller, $model);

//output page
echo $view->output();