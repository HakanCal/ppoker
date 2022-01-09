<?php
class Creationmenu extends Page implements PageInterface{
    
    function output(): string{
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
            //check if form was submitted 
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
                $roomName = htmlspecialchars($_POST['roomName']);
                $roomDescription = htmlspecialchars($_POST['roomDescription']);
                // only a title for the room is necessary
                if(isset($roomName)){
                    // insert room into db and get its key/id
                    $roomID = $this->model->setRoom(
                        $roomName,
                        $roomDescription,
                        $_SESSION['userID']);
                    $this->controller->joinRoom($_SESSION['userID'],$roomID);
                    if (isset($_POST["emails"]) && is_array($_POST["emails"])){ 
                        $emails = $_POST['emails'];
                        // only invite registered users/emails
                        foreach($emails as $email){
                            if($this->controller->emailExists($email)){
                                $this->controller->inviteUser($email,$roomID);
                            }
                        }
                    }
                    //echo "<a href=index.php?page=PPoker&room=$roomID>weiter</a>";
                    // redirect to the game after creation
                    header("Location: index.php?page=PPoker&room=$roomID");
                    exit;
                }
            //Creation page
            }else{
                $title = "PPOKER RAUM ERSTELLEN";
                ob_start();
                require "templates/createTemplate.php";
                $content =  ob_get_contents();
                ob_clean();
                require "templates/defaultTemplate.php";
            }
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }else{
            header('Location: index.php?page=Login');
        }
    }
}