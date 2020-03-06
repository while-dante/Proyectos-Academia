<?php

session_start();

foreach($_SESSION as $key => $value){
    if ($key != "usuarios"){
        unset($_SESSION[$key]);
    }
}

header("Location: ./login.php");

?>
