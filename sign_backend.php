<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $username = $_POST['user-name'];
    $email = $_POST['email'];
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
        }elseif($check > 0){
            $output = 'Email is Found!';
        }elseif(empty($password)){
            $output = 'Password is Empty!';
        }else{
            $stmt = $connect->prepare("INSERT INTO users (username, email, password, group_id, status) 
            VALUES (?, ?, ?, ?, ?)");
            $status = 'Offline Now';
            $group_id = 0;
            $stmt->bind_param('sssis', $username, $email, $password, $group_id, $status);
            $stmt->execute();

            $output = 'Success';
        }
    }
    echo $output;
?>