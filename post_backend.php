<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name-game'] ?? '';
        $type = $_POST['type-game'] ?? '';
        $describtion = $_POST['describtion'] ?? '';

        $output = '';
        $check = get_count_item("name", "games", "s", $name);

        if (empty($name) && empty($type) && empty($describtion) && empty($_FILES['image']) && empty($_FILES['game'])) {
            $output = 'All Inputs Are Empty!';
        } else {
            if (empty($name)) {
                $output = 'Name is Empty!';
            } elseif ($check > 0) {
                $output = 'Name is Found!';
            } elseif (empty($type)) {
                $output = 'Type is Empty!';
            } elseif (empty($describtion)) {
                $output = 'Description is Empty!';
            } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $output = 'Image is Empty or Upload Error!';
            } elseif (!isset($_FILES['game']) || $_FILES['game']['error'] !== UPLOAD_ERR_OK) {
                $output = 'Game File is Empty or Upload Error!';
            } else {
                $image_name = $_FILES['image']['name'];
                $image_type = $_FILES['image']['type'];
                $tmp_image_name = $_FILES['image']['tmp_name'];

                $game_name = $_FILES['game']['name'];
                $game_type = $_FILES['game']['type'];
                $tmp_game_name = $_FILES['game']['tmp_name'];

                $time = time();

                $image_explode = explode('.', $image_name);
                $image_ext = end($image_explode);

                $game_explode = explode('.', $game_name);
                $game_ext = end($game_explode);

                $allowed_image_extensions = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];
                $allowed_game_extensions = ['zip', 'rar', '7z'];

                if (!in_array($image_ext, $allowed_image_extensions)) {
                    $output = 'Invalid image format';
                } elseif (!in_array($game_ext, $allowed_game_extensions)) {
                    $output = 'Invalid game format';
                } else {
                    $new_image_name = $time . $image_name;
                    $imagePath = 'images/' . $new_image_name;

                    $new_game_name = $time . $game_name;
                    $gamePath = 'games/' . $new_game_name;

                    if (move_uploaded_file($tmp_image_name, $imagePath) && move_uploaded_file($tmp_game_name, $gamePath)) {
                        $stmt = $connect->prepare("INSERT INTO games (name, type, describtion, image, game) 
                            VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param('sssss', $name, $type, $describtion, $new_image_name, $new_game_name);
                        $stmt->execute();

                        if ($stmt) {
                            $output = 'Success';
                        } else {
                            $output = 'Failed to insert data';
                        }
                    } else {
                        $output = 'Failed to Upload Image or Game File';
                    }
                }
            }
        }
        echo $output;
    } else {
        echo 'Invalid request';
    }
?>