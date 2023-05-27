<?php
    session_start();
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $output = '';
    $check1 = get_count_item("email", "users", "s", $email);
    $check2 = get_count_item("password", "users", "s", $password);

    if(empty($email) && empty($password)){
        $output = 'All Inputs Are Empty!';
    }else{
        if(empty($email)){
            $output = 'Email is Empty!';
        }elseif(empty($password)){
            $output = 'Password is Empty!';
        }elseif( $check1 == 0 || $check2 == 0 ){
            $output = 'Profile Not Found!';
        }else{
            $stmt = $connect->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();

            $result = $stmt->get_result();

            $row  = $result->fetch_assoc();

            $upadate = $connect->prepare("UPDATE users SET status = ? WHERE email = ? AND password = ?");
            $status = 'Active Now';
            $upadate->bind_param('sss', $status, $email, $password);
            $upadate->execute();

            if($row['group_id'] == 0){
                $output = 'Hello Member';
            }else{
                $output = 'Hello Admin';
            }
            $_SESSION['user_id'] = $row['user_id'];
        }
    }
    echo $output;
?>