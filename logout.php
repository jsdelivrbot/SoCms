<?php
require('resources/config.php');

if(logged_in()){
    session_destroy();
    header('Location: index.php');
    exit(); 
} else {
    header('Refresh:5; https://gyarb-c9-theswolegeek.c9.io/', true, 303);
}
?>