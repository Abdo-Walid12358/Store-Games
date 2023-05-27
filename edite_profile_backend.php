<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $username = $_POST['user-name'];
    $email = $_POST['email'];
    $old_email = $_POST['old-email'];
    $password = $_POST['password'];

    $output = '';
    $check = get_count_item("email", "users", "s", $email);

    if(empty($username) && empty($email) && empty($password)){
        $output = 'All Inputs Are Empty!';
    }else{
        if(empty($username)){
            $output = 'Username is Empty!';
        }elseif(empty($email)){
            $output = 'Email is Empty!';
        }elseif($email != $old_email && $check > 0){
            $output = 'Email is Found!';
        }elseif(empty($password)){
            $output = 'Password is Empty!';
        }else{
            $update = $connect->prepare("UPDATE users SET username = ?, email = ?, password = ?
                WHERE user_id = ?");
            $id = $_POST['user_id'];
            $update->bind_param('sssi', $username, $email, $password, $id);
            $update->execute();

            $output = 'Success';
        }
    }
    echo $output;
?>