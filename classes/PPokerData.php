<?php

class PPokerData {
    private $dbh;
    function __construct(){
        $dbhost = 'localhost';
        $dbname='ppoker';
        $dbuser = 'root';
        $dbpass = '';
        $this->dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass) or die();
    }
    function getExample(){
        
    }
    function getRegistrationData(){}
    function getUserGameHistory(){}

}