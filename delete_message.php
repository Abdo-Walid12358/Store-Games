<?php
    include 'includes/functions/check_user.php';
    $title = 'Delete Message';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';

    if($_GET['message_id']){
        $id = $_GET['message_id'];

        $delete = $connect->prepare("DELETE FROM messages WHERE message_id = ?");
        $delete->bind_param('i', $id);
        $delete->execute();
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>
<?php
    include 'includes/templates/endhead.php'; 
?>