<?php
class ErrorPage extends Page implements PageInterface{
    function output(): string{
        return "requested site does not exist return back to <a href='index.php?page=Homepage>Homepage</a>";
    }
}