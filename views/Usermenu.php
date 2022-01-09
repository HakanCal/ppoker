<?php
class Usermenu extends Page implements PageInterface{
    function output(): string{
        ob_start();
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            //RESULTS
        }else{
            header('Location: index.php?page=Login');
        }
        $title = "i fucking hate it";
        $content = "JOHN CENA";
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}