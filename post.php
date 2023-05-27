<?php
    include 'includes/functions/check_user.php';
    $title = 'Post Game';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_admin.php';
?>

<section class="warpper-main">
    <div class="warpper sign-up post">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="box">
                <h1 class="logo">Post Game</h1>
                <div class="error-message">
                    Test
                </div>
                <div class="failed">
                    <input type="text" name="name-game" autocomplete="off" required>
                    <span>Name Game</span>
                    <i></i>
                </div>
                <div class="failed">
                    <input type="text" name="type-game" autocomplete="off" required>
                    <span>Type Game</span>
                    <i></i>
                </div>
                <div class="failed">
                    <h6>Describtion</h6>
                    <textarea name="describtion" id="" cols="30" rows="10" required></textarea>
                </div>
                <div class="failed">
                    <label for="image">Upload Image</label>
                    <input type="file" id="image" name="image" required hidden>
                </div>
                <div class="failed">
                    <label for="game">Upload Game</label>
                    <input type="file" id="game" name="game" required hidden>
                </div>
                <button>Post</button>
                <p class="link"><a href="main_admin.php">Back To Home</a></p>
            </div>
        </form>
    </div>
</section>

<script src="layout/js/post.js"></script>

<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>