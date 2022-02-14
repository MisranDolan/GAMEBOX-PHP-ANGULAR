<!--PHP file to handle the pushing of forms to the database. This includes the posting of new listings with game image and specifications-->
<?php

$errors = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // receive all input values from the form
    $title = $_POST['title'];
    $game = strtolower($_POST['game']);
    $location = $_POST['location'];
    $price = $_POST['price'];
    $game_condition = $_POST['condition'];
    $console = $_POST['console'];
    $owner = $_POST['owner'];

    $description = $_POST['description'];
    //title	description	location	price	console	sold	picture, need condition and game

    $target = "submitted_pictures/"; // . basename($picture);
    $newfilename1 = "";
    $newfilename2 = "";
    $newfilename3 = "";


    if ((count($_FILES['image']['name'])) == 3) {
        $picture = explode(".", $_FILES['image']['name'][0]);
        $picture2 = explode(".", $_FILES['image']['name'][1]);
        $picture3 = explode(".", $_FILES['image']['name'][2]);
        $newfilename1 = round(microtime(true)) . '.' . end($picture);

        $newfilename2 = round(microtime(true) + 1) . '.' . end($picture2);

        $newfilename3 = round(microtime(true) + 2) . '.' . end($picture3);

        move_uploaded_file($_FILES["image"]["tmp_name"][0], $target . $newfilename1);
        move_uploaded_file($_FILES["image"]["tmp_name"][1], $target . $newfilename2);
        move_uploaded_file($_FILES["image"]["tmp_name"][2], $target . $newfilename3);
        $msg = "Images uploaded successfully";
    } elseif (count($_FILES['image']['name']) == 2) {
        $picture = explode(".", $_FILES['image']['name'][0]);
        $picture2 = explode(".", $_FILES['image']['name'][1]);
        $newfilename1 = round(microtime(true)) . '.' . end($picture);

        $newfilename2 = round(microtime(true) + 1) . '.' . end($picture2);

        move_uploaded_file($_FILES["image"]["tmp_name"][0], $target . $newfilename1);
        move_uploaded_file($_FILES["image"]["tmp_name"][1], $target . $newfilename2);
        $msg = "Images uploaded successfully";
    } elseif (count($_FILES['image']['name']) == 1) {
        $picture = explode(".", $_FILES['image']['name'][0]);
        $newfilename1 = round(microtime(true)) . '.' . end($picture);
        move_uploaded_file($_FILES["image"]["tmp_name"][0], $target . $newfilename1);
        $msg = "Image uploaded successfully";
    } else {
        array_push($errors, "Failed to upload image");
    }

    if (count($errors) == 0) {

        $query = "INSERT INTO listing (owner,title, description, location, price, console, picture, picture2, picture3, game_condition, game) 
  			  VALUES(:owner, :title, :description, :location, :price, :console, :picture, :picture2, :picture3, :game_condition, :game)";
        $statement = $db->prepare($query);
        $statement->bindValue(':owner', $owner);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':location', $location);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':console', $console);
        $statement->bindValue(':picture', $newfilename1);
        $statement->bindValue(':picture2', $newfilename2);
        $statement->bindValue(':picture3', $newfilename3);
        $statement->bindValue(':game_condition', $game_condition);
        $statement->bindValue(':game', $game);
        $statement->execute();
        $statement->closeCursor();
        $mainpage = "index.php";

        header("Location: " . $mainpage);
    }
}
