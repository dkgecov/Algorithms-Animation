<?php
session_start();
require_once('classes.php');

function f(){
    
    if(isset($_SESSION['user']))
       return $_SESSION['user'];
       else return "";
    
}

echo f();

?>