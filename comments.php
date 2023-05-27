<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $message = $_POST['message'];
    $user_id = $_POST['user_id'];
    $game_id = $_POST['game_id'];

    if(empty($message)){
    }else{
        $stmt = $connect->prepare("INSERT INTO messages (game_id, user_id, username, message, date) 
        VALUES (?, ?, ?, ?, now())");
        
        $user = $connect->prepare("SELECT username FROM users WHERE user_id = ?");
        $user->bind_param('i', $user_id);
        $user->execute();
        $result = $user->get_result();
        $row = $result->fetch_assoc();

        $username = $row['username'];
        $stmt->bind_param('ssss', $game_id, $user_id, $username, $message);
        $stmt->execute();
    }
?>