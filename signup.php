<?php
    session_start();
    $title = 'Sign Up';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    
    if(isset($_SESSION['user_id'])){
        $stmt = $connect->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();

        $result = $stmt->get_result();

        $row  = $result->fetch_assoc();

        if($row['group_id'] == 0){
            header("location: main_member.php");
        }else{
            header("location: main_admin.php");
        }
    }
?>

<!-- <img src="images/log_in.png" alt="">
<img src="images/sign_up.png" alt=""> -->

<section class="warpper-main">
    <div class="warpper sign-up">
        <form action="">
            <div class="box">
                <h1 class="logo">Sign Up</h1>
                <div class="error-message">
                    Test
                </div>
                <div class="failed">
                    <input type="text" name="user-name" autocomplete="off" required>
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="failed">
                    <input type="email" name="email" autocomplete="off" required>
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="failed password">
                    <input type="password" name="password" autocomplete="new-password" required>
                    <span>Password</span>
                    <i></i>
                    <!-- <i class="fa-solid fa-eye"></i> -->
                </div>
                <button>Sign Up</button>
                <p class="link">Aleard Sign Up? <a href="login.php">Log In</a></p>
            </div>
        </form>
    </div>
</section>

<script src="layout/js/sign.js"></script>

<?php include 'includes/templates/endhead.php'; ?>