<?php
class PPoker extends Page implements PageInterface{
    
       
    function output(): string{
        //Show GamePage if player did not select card
        ob_start();
        require "templates/Header.php";
        //Check if user is logged in else redirect to login
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            //TODO Allow game entry only when the requesting user is participant of this room
            if($this->controller->isParticipant($_SESSION['userID'],$_GET['roomID'])){
                if(!isset($_POST['ppoker_select'])){
                    require "templates/PPokerTemplate.php";
                }else{
                    $this->model->setSelection($_SESSION['userID'], $_GET['roomID'], $_POST['ppoker_select']);
                    $html = "Deine Wahl: ".$_POST['ppoker_select'];
                }
            }else{
                echo "Du wurdest nicht zu diesem Spiel eingeladen!";
            }
        }else{
            header('Location: index.php?page=Login');
        }
        require "templates/Footer.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}