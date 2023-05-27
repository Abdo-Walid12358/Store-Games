<?php
    function getTitle($default){
        global $title;

        if(isset($title)){
            echo $title;
        }else{
            echo $default;
        }
    }
?>
