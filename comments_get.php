<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $output = '';

    $game_id = $_POST['game_id'];

    $stmt = $connect->prepare("SELECT * FROM messages WHERE game_id = ?
    ORDER BY date");
    $stmt->bind_param('i', $game_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['user_id'] == $_POST['user_id']){
                $output .= '
                    <div class="comment">
                        <h2 class="name">' . $row['username'] . '</h2>
                        <p class="message">' . $row['message'] . '</p>
                        <span class="date">' . $row['date'] . '</span>
                        <a href="delete_message.php?message_id=' . $row['message_id'] . '">Delete</a>
                    </div>
                ';
            }else{
                $output .= '
                    <div class="comment">
                        <h2 class="name">' . $row['username'] . '</h2>
                        <p class="message">' . $row['message'] . '</p>
                        <span class="date">' . $row['date'] . '</span>
                    </div>
                ';
            }
        }
    }else{
        $output = '<h3>Not Found Any Comments</h3>';
    }
    echo $output;
?>