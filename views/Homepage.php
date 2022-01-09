<?php 
class Homepage extends Page implements PageInterface{
    
    public function output() : string {
        ob_start();
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
            //USER DECLINED ROOM
            if(isset($_GET['id'])){
               $this->model->deleteParticipation($_SESSION['userID'],$_GET['id']);
            }
            // SHOW INVITES / PARTICIPATIONS
            echo "
                <table class='table table-striped'>
                <tr>
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th colspan='2'>Aktion</th>
                </tr>
            ";
            // USER CAN JOIN ONGOING GAMES 
            foreach($this->model->getParticipationsByUser($_SESSION['userID']) as $participation){
                if(!$this->controller->isRoomDone($participation['raumid'])){
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
            $title1 = "Einladungen und offene Spiele";
            $content1 = ob_get_contents();
            ob_clean();
        }else{
            $title1 = "Startseite";
            $content1 = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit adipisci repellat itaque mollitia at maxime modi neque id earum labore. Nostrum in sint eaque, eligendi sequi placeat reprehenderit excepturi atque.";
        }
        $title2 = "Ergebnisse";
        $content2 = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit adipisci repellat itaque mollitia at maxime modi neque id earum labore. Nostrum in sint eaque, eligendi sequi placeat reprehenderit excepturi atque.";
        $title3 = "Spiel erstellen";
        $content3 = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit adipisci repellat itaque mollitia at maxime modi neque id earum labore. Nostrum in sint eaque, eligendi sequi placeat reprehenderit excepturi atque.";
        require "templates/defaultJumbo.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}