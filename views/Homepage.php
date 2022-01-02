<?php 
class Homepage extends Page implements PageInterface{
    
    public function output() : string {
        $html = "some html <a href='index.php?page=Login'>Click me </a> ";
        return $html;
    }
}