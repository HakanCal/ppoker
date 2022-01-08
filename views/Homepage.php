<?php 
class Homepage extends Page implements PageInterface{
    
    public function output() : string {
        // show invites 
        ob_start();
        if($_SESSION['loggedIn']){
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
                    $name = $room['name'];
                    $description = $room['beschreibung'];
                    //Table from which user can join room or decline invite
                    echo "
                    <tr>
                        <td> $name </td>
                        <td> $description </td>
                        <td> <a class='btn btn-success' href=index.php?page=PPoker&room=".$participation['raumid'].">Teilnehmen</a></td>
                        <td> <a class='btn btn-danger' href=index.php?id=>Ablehnen</a></td>
                    </tr>
                ";
                    //Join the PPoker room
                    //echo "<a class='btn btn-success' href=index.php?page=PPoker&room=".$participation['raumid'].">Teilnehmen</a>"; 
                    // Decline link delete invitation from db
                    //echo "<a class='btn btn-danger' href=index.php?id=$>Ablehnen</a>"; 
                }
            }
            echo "</table>";
            // then join from them 
        }
        /*
        echo
        "<a href='index.php?page=Login'>Login Page</a><br>
        <a href='index.php?page=Creationmenu'>Creationmenu</a><br>
        <a href='index.php?page=PPoker'>PPoker</a><br>
        <a href='index.php?page=Results'>Results</a><br>
        <a href='index.php?page=Usermenu'>Usermenu</a><br>";
        */
        $title = "Einladungen";
        $content = ob_get_contents();
        ob_clean();
        require "templates/defaultTemplate.php";
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}