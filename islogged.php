<?php

session_start();

function islogged(){
if( $_SESSION['logged_in'] == 1)
return 1;
else return 0;
}
echo islogged();
?>