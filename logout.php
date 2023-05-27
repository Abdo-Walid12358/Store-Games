<?php
    session_start();
    $title = 'Log Out';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';

    $update = $connect->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    $status = 'Offline Now';
    $user_id = $_SESSION['user_id'];
    $update->bind_param('si', $status, $user_id);
    $update->execute();

    session_unset();
    session_destroy();

    header("location: login.php");
?>
<?php include 'includes/templates/endhead.php'; ?>