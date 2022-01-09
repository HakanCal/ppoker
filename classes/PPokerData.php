<?php
/*
    FUNCTIONS FOR DATABASES
    PDO WAS USED
 */
class PPokerData {
    private $dbh;
    function __construct(){
        $dbhost = 'localhost';
        $dbname='ppoker';
        $dbuser = 'root';
        $dbpass = '';
        try{
            $this->dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
        }catch(PDOException $ex){
            echo "Verbindung zur Datenbank fehlgeschlagen $ex->getMessage()";
        }
    }
    //getters
    function getUserByEmailAndPwd($email, $pwd){
        $sql="SELECT * from benutzer WHERE email=:mail AND passwort=:pwd";
        $stmt= $this->dbh->prepare($sql);
        $stmt->bindValue(":mail", $email);
        $stmt->bindValue(":pwd", $pwd);
        $stmt->execute();
        return $stmt->fetch();
    }
    function getSelection($participantID, $roomID){
        $sql = "SELECT punktzahl FROM teilnehmer WHERE 
        teilnehmerID = :participantID AND 
        raumID = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":participantID",$participantID);
        $stmt->bindValue(":roomID",$roomID);
        return $stmt->fetch();
    }
    function getUser($email){
        $sql = "SELECT * FROM benutzer WHERE email = :email";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        return $stmt->fetch();
    }
    function getUserByID($userID){
        $sql = "SELECT * FROM benutzer WHERE userid = :userID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":userID",$userID);
        $stmt->execute();
        return $stmt->fetch();
    }
    function getParticipationsByUser($userID){
        $sql = "SELECT * FROM teilnehmer WHERE teilnehmerid = :userID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":userID",$userID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getParticipationsByRoom($roomID){
        $sql = "SELECT * FROM teilnehmer WHERE raumid = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":roomID",$roomID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getParticipationByUserAndRoom($userID,$roomID){
        $sql = "SELECT * FROM teilnehmer WHERE teilnehmerid = :userID AND raumid = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":userID",$userID);
        $stmt->bindValue(":roomID",$roomID);
        $stmt->execute();
        return $stmt->fetch();
    }
    function getRoom($roomID){
        $sql = "SELECT * FROM raum WHERE raumid = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":roomID",$roomID);
        $stmt->execute();
        return $stmt->fetch();
    }
    //setters
    function createUser($name, $familyName, $hashPwd, $email){
        $sql="INSERT INTO benutzer (vorname, nachname, email, passwort) VALUES (:name, :familyname, :mail , :pwd) ";
        $stmt= $this->dbh->prepare($sql);
        $stmt->bindValue(":name",$name);
        $stmt->bindValue(":familyname",$familyName);
        $stmt->bindValue(":mail",$email);
        $stmt->bindValue(":pwd",$hashPwd);
        $stmt->execute();
    }
    function setSelection($teilnehmerID, $roomID, $selection){
        $sql = "UPDATE teilnehmer SET punktzahl = :selection WHERE teilnehmerID = :teilnehmerID AND raumID = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":selection",$selection);
        $stmt->bindValue(":teilnehmerID",$teilnehmerID);
        $stmt->bindValue(":roomID",$roomID);
        $stmt->execute();
    }
    function setRoom($roomName, $roomDescription, $userID){
            $sql = "INSERT INTO raum(name, beschreibung, erstellerID) VALUES(
            :roomName,
            :roomDescription,
            :userID
        )";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":roomName", $roomName);
        $stmt->bindValue(":roomDescription", $roomDescription === '' ? null : $roomDescription, PDO::PARAM_STR);
        $stmt->bindValue(":userID", $userID);
        $stmt->execute();
        return $this->dbh->lastInsertId();
    }
    function setUserToRoom($userID,$roomID){
        $sql = "INSERT INTO teilnehmer(teilnehmerID, raumID) VALUES(:userID, :roomID)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":userID", $userID);
        $stmt->bindValue(":roomID", $roomID);
        return $stmt->execute();
    }
    function setRoomResults($roomID, $avg, $max, $min){
        $sql = "UPDATE raum SET mittelwert = :average , maximum = :maximum , minimum = :minimum WHERE raumid = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":roomID", $roomID);
        $stmt->bindValue(":average", $avg);
        $stmt->bindValue(":maximum", $max);
        $stmt->bindValue(":minimum", $min);
        return $stmt->execute();
    }
    function deleteParticipation($userID,$roomID){
        $sql = "DELETE FROM teilnehmer WHERE teilnehmerid = :userID AND raumid = :roomID";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(":userID", $userID);
        $stmt->bindValue(":roomID", $roomID);
        return $stmt->execute();
    }
}