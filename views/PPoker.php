<?php
/*
    DISPLAYS THE GAME MENU 
    HANDLES ITS OWN POST REQUEST FOR USER SELECTION
    ROOM CREATOR ALSO HAS BUTTON TO EVALUATE GAME AND END ROOM
    REDIRECTS TO RESULTS TABLE
*/
class PPoker extends Page implements PageInterface{
    
    function output(): string{
        ob_start();
        // USER HAS TO BE LOGGED IN FOR THIS PAGE
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            // ROOMS ONLY FOR PARTICIPANTS
            $userID = htmlspecialchars($_SESSION['userID']);
            $roomID = htmlspecialchars($_GET['room']);
            if($this->controller->isParticipant($userID,$roomID)){
                // IF GAME IS DONE DONT SHOW GAME 
                // TODO: SHOW DIFFERENT PAGE
                if($this->controller->isRoomDone($roomID)){
                    $title =  "Dieses Spiel wurde beendet!";
                    $content = "Zu deinen <a href='index.php?page=Results'>Ergebnissen</a>";

                }
                else{ // SHOW GAME
                    // SET USERS SELECTION
                    if(isset($_POST['ppoker_select'])){
                        $userSelection = htmlspecialchars($_POST['ppoker_select']);
                        $this->model->setSelection($userID, $roomID, $userSelection);
                        echo "Deine Wahl: $userSelection";
                    }                
                    // ONLY CREATOR CAN EVALUATE THE GAME
                    $eva_btn = "";
                    $room = $this->model->getRoom($roomID);
                    if($userID == $room['erstellerid']){
                        //DISPLAY END BUTTON
                        $eva_btn="
                        <form action='index.php?page=PPoker&room=$roomID' method='post'>
                            <div class='row form-group'>
                                <input class='btn btn-primary btn-lg' type='submit' name='auswerten' value='Auswerten'> 
                            </div>
                        </form>";
                        if(isset($_POST['auswerten'])){
                            $this->controller->endRoom($roomID);
                            header('Location: index.php?page=Results'); 
                            exit;               
                        }
                    }
                    $ppoker_title = $room['name'];
                    $ppoker_description = $room['beschreibung'];
                    $ppoker_evaluate_btn = $eva_btn;
                    require "templates/PPokerTemplate.php";
                    $title = "PPOKER";
                    $content = ob_get_contents();
                }
            }else{
                $title = "NICHT EINGELADEN :/";
                $content = "Du bist nicht zu diesem Spiel eingeladen!";
            }
            ob_clean();
            require "templates/defaultTemplate.php";
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
        header('Location: index.php?page=Login');
        exit;

    }
}