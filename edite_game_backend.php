<?php
    include 'includes/functions/connect.php';
    include 'includes/functions/check_item.php';

    $name = $_POST['name-game'];
    $type = $_POST['type-game'];
    $describtion = $_POST['describtion'];
    $id = $_POST['id'];

    $output = '';
    $check = get_count_item("name", "games", "s", $name);

    if(empty($name) && empty($type) && empty($describtion) && empty($_FILES['image']['size'])){
        $output = 'All Inputs Are Empty!';
    }else{
        if(empty($name)){
            $output = 'Name is Empty!';
        }elseif($check > 1){
            $output = 'Name is Found!';
        }elseif(empty($type)){
            $output = 'Type is Empty!';
        }elseif(empty($describtion)){
            $output = 'Describtion is Empty!';
        }else{
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $image_name = $_FILES['image']['name'];
                $image_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $time = time();

                $image_explode = explode('.', $image_name);
                $image_ext = end($image_explode);

                $extension = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];

                if(in_array($image_ext, $extension) == true){
                    $new_image_name = $time.$image_name;

                    if(move_uploaded_file($tmp_name, 'images/' . $new_image_name)){

                        $update = $connect->prepare("UPDATE games SET name = ?, type = ?,
                        describtion = ?, image = ? WHERE id = ?");
                        $update->bind_param('ssssi', $name, $type, $describtion, $new_image_name, $id);
                        $update->execute();

                        if ($update) {
                            $output = 'Success';
                        }else{
                            $output = 'Wrong!';
                        }
                    }
                }else{
                    $output = 'This is not an image';
                }
            }else{
                $output = 'Image Is Empty!';
            }
        }
    }
    echo $output;
?>