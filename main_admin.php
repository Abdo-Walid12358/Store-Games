<?php
    include 'includes/functions/check_user.php';
    $title = 'Dashboard By Admin';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_admin.php';

    $stmt = $connect->prepare("SELECT * FROM games");
    $stmt->execute();

    $result = $stmt->get_result();

    ?>

<section class="home">
    <img src="images/stray-stray-cat.jpg" alt="">
</section>

<section class="heading">
    <i class="fa-solid fa-house"></i>
    <h3>Games</h3>
</section>

<section class="cards">
    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ 

            $game_id = $row['id'];

            $stmt2 = $connect->prepare("SELECT AVG(rating) AS average_rating FROM rating WHERE game_id = ?");
            $stmt2->bind_param('i', $game_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if($result2->num_rows > 0){
                $row2 = $result2->fetch_assoc();
                $averageRating = number_format($row2['average_rating'], 1);
            } else {
                $averageRating = 0;
            }
        ?>
        <div class="card">
            <a href="game.php?game_id=<?php echo $row['id'] ?>">
            <img src="images/<?php echo $row['image']; ?>" alt="">
            </a>
            <div class="texts">
                <span><?php echo $row['name']; ?></span>
                <span><?php echo $row['type']; ?></span>
                <div class="status">
                    <i class="fa-solid fa-star"></i>
                    <span><?php echo $averageRating; ?></span>
                </div>
                <div class="controls">
                    <a href="delete_game.php?id=<?php echo $row['id']; ?>">Delete</a>
                    <a href="edite_game.php?id=<?php echo $row['id']; ?>">Edite</a>
                </div>
            </div>
        </div>
    <?php
        }
    }else{?>
        <h3>Not Found Any Game</h3>
    <?php } ?>
</section>

<!-- <script>
window.addEventListener('beforeunload', function(event) {
    event.preventDefault();
    event.returnValue = '';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'logout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // تم التصرف بنجاح
        }
    };
    xhr.send();
});
</script> -->

<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>