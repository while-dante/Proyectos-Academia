<?php

session_start();

foreach($_SESSION as $key => $value){
    if ($key != "usuarios" and $_key != "reg"){
        unset($_SESSION[$key]);
    }
}

header("Location: ./index.php?page=login");

?>
