<?php
class PPoker extends Page implements PageInterface{
    
       
    function output(): string{
        //Show GamePage if player did not select card
        ob_start();
        //Check if user is logged in else redirect to login
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            //TODO Allow game entry only when the requesting user is participant of this room
            $userID = htmlspecialchars($_SESSION['userID']);
            $roomID = htmlspecialchars($_GET['room']);
            if($this->controller->isParticipant($userID,$roomID)){
                //Game was finished by creator
                $room = $this->model->getRoom($roomID);
                if(isset($room['mittelwert'])){
                    echo "Diese Spiel ist wurde vom Ersteller beendet!";
                    echo "Zu deinen <a href='index.php?page=Results'>Ergebnissen</a>";
                }
                // Only do this when a selection was made
                if(isset($_POST['ppoker_select'])){
                    $userSelection = htmlspecialchars($_POST['ppoker_select']);
                    $this->model->setSelection($userID, $roomID, $userSelection);
                    echo "Deine Wahl: $userSelection";
                }
                
                if(is_array($room)){
                    // Only game creator has access to this button
                    if($userID == $room['erstellerid']){
                        //display end game button
                        echo "
                        <form action='index.php?page=PPoker&room=$roomID' method='post'>
                            <div class='row form-group'>
                                <input class='btn btn-primary btn-lg' type='submit' name='auswerten' value='Auswerten'> 
                            </div>
                        </form>";
                        if(isset($_POST['auswerten'])){
                            $this->controller->endRoom($roomID);
                            header('Location: index.php?page=Results');                
                        }
                    }
                }
                require "templates/PPokerTemplate.php";
            }else{
                echo "Du wurdest nicht zu diesem Spiel eingeladen!";
            }
        }else{
            header('Location: index.php?page=Login');
        }
        $title = "PPOKER";
        $content = ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}