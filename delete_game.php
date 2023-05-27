<?php
    include 'includes/functions/check_user.php';
    $title = 'Delete Game';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';

    if($_GET['id']){
        $id = $_GET['id'];

        $stmt = $connect->prepare("SELECT image FROM games WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $delete = $connect->prepare("DELETE FROM games WHERE id = ?");
        $delete->bind_param('i', $id);
        $delete->execute();

        $delete_comments = $connect->prepare("DELETE FROM messages WHERE game_id = ?");
        $delete_comments->bind_param('i', $id);
        $delete_comments->execute();

        $gameName = $row['game'];
        $gamePath = "games/" . $gameName;
        if (file_exists($gamePath)) {
            unlink($gamePath);
        }
        
        $imageName = $row['image'];
        $imagePath = "images/" . $imageName;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>
<?php
    include 'includes/templates/endhead.php'; 
?>