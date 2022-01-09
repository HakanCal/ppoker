<?php 
class Homepage extends Page implements PageInterface{
    
    public function output() : string {
        // show invites 
        ob_start();
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
            // show games he is now part of
            echo "
                <table class='table table-striped'>
                <tr>
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th>Aktion</th>
                </tr>
            ";
            foreach($this->model->getParticipationsByUser($_SESSION['userID']) as $participation){
                if(!isset($participation['punktzahl'])){
                    //Display Room info 
                    $room = $this->model->getRoom($participation['raumid']);
                    if(is_array($room) && !isset($room['mittelwert'])){
                        $name = $room['name'];
                        $description = $room['beschreibung'];
                        //Table from which user can join room or decline invite
                        echo "
                        <tr>
                            <td> $name </td>
                            <td> $description </td>
                            <td> <a class='btn btn-success' href=index.php?page=PPoker&room=".$participation['raumid'].">Teilnehmen</a></td>
                            <td> <a class='btn btn-danger' href=index.php?id=".$participation['raumid'].">Ablehnen</a></td>
                        </tr>
                    ";
                    }
                }
            }
            echo "</table>";
            // then join from them 
        }
        $title = "Einladungen";
        $content = ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}