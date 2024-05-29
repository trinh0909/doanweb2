<?php
    session_start();
    if(isset($_POST['dangxuat'])){
        unset($_SESSION['user']);
        unset($_SESSION['pass']);
    }
    if(isset($_POST['dangxuatus'])){
        if(isset($_SESSION['user']))
            {
                unset($_SESSION['user']);
                unset($_SESSION['pass']);
                echo 1;
            }
        else echo 0;
    }
?>