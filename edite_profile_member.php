<?php
    include 'includes/functions/check_user.php';
    $title = 'Edite Profile';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_member.php';

    $stmt = $connect->prepare("SELECT * FROM users WHERE user_id = ?");
    $id = $_SESSION['user_id'];
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
?>

<section class="warpper-main">
    <div class="warpper sign-up edite-profile">
        <form action="">
            <div class="box">
                <h1 class="logo">Edite Profile</h1>
                <div class="error-message">
                    Test
                </div>
                <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>" hidden>
                <div class="failed">
                    <input type="text" name="user-name" value="<?php echo $row['username']; ?>" autocomplete="off" required>
                    <span>Username</span>
                    <i></i>
                </div>
                <div class="failed">
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" autocomplete="off" required>
                    <input type="email" name="old-email" value="<?php echo $row['email']; ?>" hidden>
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="failed password">
                    <input type="password" name="password" value="<?php echo $row['password']; ?>" autocomplete="new-password" required>
                    <span>Password</span>
                    <i></i>
                    <!-- <i class="fa-solid fa-eye"></i> -->
                </div>
                <button>Update</button>
                <p class="link"><a href="main_member.php">Back To Home</a></p>
            </div>
        </form>
    </div>
</section>

<script src="layout/js/edite_profile.js"></script>

<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>