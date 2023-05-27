<?php
    include 'includes/functions/check_user.php';
    $title = 'Rating Game';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $game_id = $_POST['game_id'];
        $user_id = $_POST['user_id'];
        $rating = $_POST['rating'];
        
        $checkStmt = $connect->prepare("SELECT id FROM rating WHERE user_id = ? AND game_id = ?");
        $checkStmt->bind_param('ii', $user_id, $game_id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0){
            $row = $checkResult->fetch_assoc();
            $stmt = $connect->prepare("UPDATE rating SET user_id = ?,
            game_id = ?, rating = ? WHERE id = ?");
            $stmt->bind_param('iiii', $user_id, $game_id, $rating, $row['id']);
            $stmt->execute();
        }else{
            $stmt = $connect->prepare("INSERT INTO rating (user_id, game_id, rating) 
            VALUES (?, ?, ?)");
            $stmt->bind_param('iii', $user_id, $game_id, $rating);
            $stmt->execute();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
?>