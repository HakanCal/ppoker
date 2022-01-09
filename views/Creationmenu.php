<?php
/*
    CREATION CLASS OUTPUTS THE MENU TO CREATE A GAME OF PPOKER
    PAGE ALSO HANDLES IT POST REQUEST AND REDIRECTS TO GAME
*/
class Creationmenu extends Page implements PageInterface{
    
    function output(): string{
        // USER HAS TO BE LOGGED IN FOR THIS PAGE
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
            //IF FORM WAS SUBMITTED 
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
                $roomName = htmlspecialchars($_POST['roomName']);
                $roomDescription = htmlspecialchars($_POST['roomDescription']);
                // ROOM NEEDS ONLY TITLE
                if(!empty($roomName)){
                    // INSERT NAME, DESCRIPTION AND CREATOR TO ROOM
                    $roomID = $this->model->setRoom(
                        $roomName,
                        $roomDescription,
                        $_SESSION['userID']
                    );
                    //CREATOR JOINS ROOM IMMEDIATELY
                    $this->controller->joinRoom($_SESSION['userID'],$roomID);

                    // INVITE OTHERS EXCEPT YOURSELF BY EMAIL
                    $myEmail = $this->model->getUser($_SESSION['userID'])['email'];
                    if (isset($_POST["emails"]) && is_array($_POST["emails"])){
                        $emails = $_POST['emails'];
                        $emails = array_unique($emails); // PREVENT SAME USER INVITATIONS 
                        foreach($emails as $email){
                            $email = htmlspecialchars($email);
                            if($email != $myEmail ){
                                $this->controller->inviteUser($email,$roomID);
                            }
                        }
                    }
                    // REDIRECT TO GAME
                    header("Location: index.php?page=PPoker&room=$roomID");
                    exit;
                }
            //IF NOT SUBMITTED OR NO NAME SET:
            }
            $title = "PPOKER RAUM ERSTELLEN";
            ob_start();
            require "templates/createTemplate.php";
            $content =  ob_get_contents();
            ob_clean();
            require "templates/defaultTemplate.php";
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
        // IF NOT LOGGED IN
        header('Location: index.php?page=Login');
        exit;
    }
}