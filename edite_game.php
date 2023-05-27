<?php
    include 'includes/functions/check_user.php';
    $title = 'Edite Game';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_admin.php';

    if(isset($_GET['id']) && $_GET['id'] >= 1){
        $stmt = $connect->prepare("SELECT * FROM games WHERE id = ?");
        $id = $_GET['id'];
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        if($result->num_rows == 0){
            header('Location: main_admin.php');
            exit;
        }
    }else{
        header('Location: main_admin.php');
        exit;
    }
?>

<section class="warpper-main">
    <div class="warpper sign-up post">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="box">
                <h1 class="logo">Edite Game</h1>
                <div class="error-message">
                    Test
                </div>
                <input type="text" name="id" value="<?php echo $row['id']; ?>" autocomplete="off" required hidden>
                <div class="failed">
                    <input type="text" name="name-game" value="<?php echo $row['name']; ?>" autocomplete="off" required>
                    <span>Name Game</span>
                    <i></i>
                </div>
                <div class="failed">
                    <input type="text" name="type-game" value="<?php echo $row['type']; ?>" autocomplete="off" required>
                    <span>Type Game</span>
                    <i></i>
                </div>
                <div class="failed">
                    <h6>Describtion</h6>
                    <textarea name="describtion" id="" cols="30" rows="10" required><?php echo $row['describtion']; ?></textarea>
                </div>
                <div class="failed">
                    <label for="image">Upload Image</label>
                    <input type="file" id="image" name="image" value="<?php echo $row['image']; ?>" required hidden>
                </div>
                <button>Update</button>
                <p class="link"><a href="main_admin.php">Back To Home</a></p>
            </div>
        </form>
    </div>
</section>

<script src="layout/js/edite_game.js"></script>

<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>