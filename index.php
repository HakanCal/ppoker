<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

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

//catch wrong page requests
$pagePath = "views/".$page.".php";
if(!file_exists($pagePath)){
    $pagePath = "views/ErrorPage.php";
    $page = "ErrorPage";
}
require_once $pagePath;
//include view from page request

$model = new PPokerData();
$controller = new PPokerActions($model);
$view = new $page($controller, $model);

//output page
echo $view->output();