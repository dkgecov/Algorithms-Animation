<?php
    session_unset();
       if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time(), '/');
       }
        session_destroy();
       header('Location: homepage.html');
?>