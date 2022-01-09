<?php 
/*
    DISPLAYS SIMPLE LOGIN PAGE
    HANDLES ITS OWN POST REQUEST FOR LOGIN
 */
class Login extends Page implements PageInterface{
    
    function output(): string{
        ob_start();
        if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['submit'])){
            $email = htmlspecialchars($_POST['email']);
            $pwd = htmlspecialchars($_POST['password']);
            $this->controller->Login($email,$pwd);
            //header('Location: index.php');        
        }   
        require "templates/LoginTemplate.php";
        $title = "ANMELDEN";
        $content = ob_get_contents();
        ob_clean();
        require "templates/infoTemplate.php";
        $info =  ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}