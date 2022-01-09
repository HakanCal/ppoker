<?php 

class PPokerActions{
    
    private $model;
    function __construct($model){
        $this->model = $model;
    }
    //REGISTRATION CREATE USER IF EVERYTHING IS VALID
    function registration($registrationName, $registrationlastName, $registrationPwd, $registrationPwdRe, $registrationEmail){
        if($this->validateRegistration($registrationName, $registrationlastName,$registrationPwd, $registrationPwdRe, $registrationEmail)){
            $hashPwd=md5($registrationPwd);
            $this->model->createUser($registrationName, $registrationlastName, $hashPwd, $registrationEmail);
            echo "Account wurde erstellt sie können sich jetzt einloggen<br>";
        }       
    }
    // CHECKS REGISTRATION IF EMAIL IS VALID AND NOT ALREADY IN USE
    function validateRegistrationEmail($email){
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "Fehler geben sie eine valide Email ein <br>";
        }
        if($this->emailExists($email)){
            return "Email wird bereits verwendet<br>";
        }
        return "";
    }
    // CHECK REGISTRATION IF NAMES ARE FILLED
    function validateRegistrationNames($firstName,$lastName){
        if(!empty($firstName)&&!empty($lastName)){
            return "";
        }
        return "Fehler bitte geben sie ihren Vor- und Nachnamen an<br>";
    }
    // CHECK IF USER PASSWORD IS REPEATED CORRECT
    public function validateRegistrationPassword($pwd, $repeatedpwd){
        if(isset($pwd) && $pwd==$repeatedpwd){
            return "";
        }
        return "Fehler die Passwörter stimmen nicht über ein <br>";    
    }
    function validateRegistration($regName, $regLastName,$regPwd, $regPwdRe, $regEmail): bool{ 
        $errors = array();
        array_push($errors,$this->validateRegistrationEmail($regEmail));
        array_push($errors,$this->validateRegistrationPassword($regPwd, $regPwdRe));
        array_push($errors,$this->validateRegistrationNames($regName,$regLastName));
        $isEmpty = true;
        foreach($errors as $error){
            if(!empty($error)){
                echo "<div class='alert alert-danger'>
                    <strong>Fehler</strong> $error </div>";
                $isEmpty = false;
            }
        }
        if($isEmpty){
            echo "<div class='alert alert-success' role='alert'>
                Erfolgreich registriert! <a href='index.php?page=Login'>Anmelden</a>
                </div>";
            return true;
        }
        return false;
    }
    // VALIDATES LOGIN EMAIL AND PASSWORD
    function validateLogin($email, $pwd){
        if(empty($email)||empty($pwd)){
            return "Bitte geben sie eine Email und Passwort an";
        }
        $hashedPwd=md5($pwd);
        // Look if email and password are registered
        $user=$this->model->getUserByEmailAndPwd($email, $hashedPwd);
        if(!is_array($user)){
            return "Fehlgeschlagen";
        }
        return "";
    }
    function login($email,$pwd){
        $error = $this->validateLogin($email, $pwd);
        if(empty($error)){
            $hashedPwd=md5($pwd);
            $user=$this->model->getUserByEmailAndPwd($email, $hashedPwd);
            $_SESSION['loggedIn'] = true;
            $_SESSION['userID'] = $user['userid'];
            $_SESSION['name'] = $user['vorname'];
            echo "<div class='alert alert-success' role='alert'>
                Erfolgreich angemeldet! <a href='index.php?page=Creationmenu'>Spiel erstellen</a>
                </div>";
            return true;
        }
        echo "<div class='alert alert-danger'>
            <strong>Fehler</strong> $error </div>";
        return false;
    }
    //Determine average score
    function calculateAvg($result){
        $avg = 0;
        foreach($result as $score){
            $avg += $score;
        }
        $avg /= sizeof($result);
        return $avg;
    }
    //Get selection from participants that selected
    //Determine the average, max and min selection
    //Update results into room
    function endRoom($roomID){
        $points = array();
        foreach($this->model->getParticipationsByRoom($roomID) as $participation){
            if(isset($participation['punktzahl'])){
                array_push($points,$participation['punktzahl']);
            }
        }
        // IF NO ONE SELECTED ANYTHING JUST PLACE 0
        if($points){
            $points = array(0);
        }
        $avg = $this->calculateAvg($points);
        $max = max($points);
        $min = min($points);
        $this->model->setRoomResults($roomID,$avg,$max,$min);
    }
    //SET USER TO ROOM
    function joinRoom($userID,$roomID){
        $this->model->setUserToRoom($userID,$roomID);
    }
    //CHECK IF EMAIL IS REGISTRATED
    function emailExists($email): bool{
        return is_array($this->model->getUser($email));
    }
    // ADDS USER VIA HIS EMAIL TO ROOM 
    function inviteUser($email,$roomID): bool{
        if($this->emailExists($email)){
            $user = $this->model->getUser($email);
            $userID = $user['userid'];
            if(!$this->isParticipant($userID,$roomID)){
                $this->joinRoom($userID,$roomID);
                return true;
            }
            return false;
        }
    }
    // CHECKS IF USER IS PARTICIPANT OF ROOM
    function isParticipant($userID, $roomID): bool{
        return is_array($this->model->getParticipationByUserAndRoom($userID,$roomID));
    }
}