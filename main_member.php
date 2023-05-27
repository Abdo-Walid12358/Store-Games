<?php
    include 'includes/functions/check_user.php';
    $title = 'Games';
    include 'includes/templates/head.php';
    include 'includes/functions/connect.php';
    include 'header_member.php'; 

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
            <a href="game_member.php?game_id=<?php echo $row['id'] ?>">
            <img src="images/<?php echo $row['image']; ?>" alt="">
            </a>
                <div class="texts texts-member">
                <span><?php echo $row['name']; ?></span>
                <span><?php echo $row['type']; ?></span>
                <div class="status">
                    <i class="fa-solid fa-star"></i>
                    <span><?php echo $averageRating; ?></span>
                </div>
            </div>
        </div>
    <?php
        }
    }else{?>
        <h3>Not Found Any Game</h3>
    <?php } ?>
</section>


<?php
    include 'includes/templates/footer.php';
    include 'includes/templates/endhead.php'; 
?>