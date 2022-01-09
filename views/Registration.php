<?php 
class Registration extends Page implements PageInterface{
    
    function output(): string{
        ob_start();
        if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['submit'])){  
            $this->controller->registration(
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['password'],
                $_POST['rePassword'],
                $_POST['email']
            );
        }
        require "templates/RegisterTemplate.php";
        $title = "REGISTRIERUNG";
        $content = ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}