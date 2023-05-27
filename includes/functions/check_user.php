<?php
    session_start();

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     header("location: login.php");
    // }
    if(isset($_SESSION['user_id'])){
    }else{
        header("location: login.php");
    }
?>