<?php
    include 'includes/functions/check_user.php';
    $title = 'The Game';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_admin.php';

    $stmt = $connect->prepare("SELECT * FROM games WHERE id = ?");
    $game_id = $_GET['game_id'];
    $stmt->bind_param('i', $game_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
?>

<section class="game">
    <div class="photo-game">
        <h1><?php echo $row['name']; ?></h1>
        <img src="images/<?php echo $row['image']; ?>" alt="">
    </div>
    <div class="about-game">
        <h1>About Game</h1>
        <p>
            Type : <?php echo $row['type']; ?><br>
            <?php echo $row['describtion']; ?>
        </p>
    </div>
    <div class="link-game">
        <h1>Download Game</h1>
        <button><a href="games/<?php echo $row['game']; ?>">Download</a></button>
    </div>
    <div class="rating-conrner">
        <h1>Rating Game</h1>
        <form action="rating.php" method="POST">
            <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" checked>
                <label for="star5" title="5 stars"></label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars"></label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars"></label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars"></label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" title="1 star"></label>
            </div>
            <button type="submit">Send Rating</button>
        </form>
    </div>
    <div class="comment-game">
        <h1>Comments Game</h1>
        <form action="">
            <div class="failed">
                <label>Message</label>
                <input type="text" name="game_id" value="<?php echo $game_id ?>" hidden>
                <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                <textarea name="message" id="" cols="30" rows="10" required></textarea>
            </div>
            <button>Send Comment</button>
        </form>
    </div>
    <div class="comments">
    </div>
</section>

<script src="layout/js/game.js"></script>

<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>