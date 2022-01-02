<?php 
class Login extends Page implements PageInterface{
    
    function output(): string{
        $html = $this->model->getRegistrationData();
        ob_start();
        require "templates/Header.php";
        require "templates/LoginTemplate.php";
        require "templates/Footer.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}