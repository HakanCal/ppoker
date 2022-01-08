<?php 

class PPokerActions{
    
    private $model;
    function __construct($model){
        $this->model = $model;
    }
    //Calculate average, max and min score
    //TODO AND PUT INTO DATABASE PLEASE
    function calculateMax($result){
        $max = $result[0];
        foreach($result as $score){
            $max = $max > $score ? $max : $score;
        }
        return $max;
    }
    function calculateMin($result){
        $min = $result[0];
        foreach($result as $score){
            $min = $min < $score ? $min : $score;
        }
        return $min;
    }
    function calculateAvg($result){
        $avg = 0;
        foreach($result as $score){
            $avg += $score;
        }
        $avg /= sizeof($result);
        return $avg;
    }
    function joinRoom($userID,$roomID){
        //set user to room
        $this->model->setUserToRoom($userID,$roomID);
    }
    //TODO: Maybe does not work as intended
    function emailExists($email){
        while($row = $this->model->getUser($email)){
            return true;
        }
        return false;
    }
    function inviteUser($email,$roomID){
        $userRow = $this->model->getUser($email);
        $userID = $userRow['userid'];
        $this->joinRoom($userID,$roomID);
    }
}