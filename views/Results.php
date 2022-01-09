<?php
/*
    DISPLAYS RESULTS OF ALL GAMES THE CURRENT USER SELECTED SOMETHING AND
    ROOM WAS EVALUATED
    CREATES A TABLE WITH ALL GAMES
 */
class Results extends Page implements PageInterface{
    function output(): string{
        ob_start();
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            //RESULTS
            echo "
            <div class='table-responsive'>
                <table class='table table-striped'><tr>
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th>Mittelwert</th>
                    <th>Maximum</th>
                    <th>Minimum</th>
                </tr>
            ";
            // SHOW ALL GAMES WHERE SELECTION WAS MADE AND GAME IS DONE
            foreach($this->model->getParticipationsByUser($_SESSION['userID']) as $participation){
                $room = $this->model->getRoom($participation['raumid']);
                if(isset($participation['punktzahl']) && $this->controller->isRoomDone($room['raumid'])){
                    $name = "";
                    $description = "";
                    $avg = 0;
                    $max = 0;
                    $min = 0;
                    $name = $room['name'];
                    $description = $room['beschreibung'];
                    if(!is_null($room['mittelwert'])){
                        $avg = $room['mittelwert'];
                    }
                    if(!is_null($room['maximum'])){
                        $max = $room['maximum'];
                    }
                    if(!is_null($room['minimum'])){
                        $min = $room['minimum'];
                    }
                    echo "
                        <tr>
                            <td> $name </td>
                            <td> $description </td>
                            <td> $avg </td>
                            <td> $max </td>
                            <td> $min </td>
                        </tr>
                    ";
                }
            }
            echo "</table></div>";
        }else{
            header('Location: index.php?page=Login');
            exit;
        }
        $title = "Spiele Verlauf";
        $content = ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}