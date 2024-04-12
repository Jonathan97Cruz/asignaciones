<?php

session_start();
if( $_SESSION['active'] == true ){
    session_destroy();
    header('location:../index.php');
}

