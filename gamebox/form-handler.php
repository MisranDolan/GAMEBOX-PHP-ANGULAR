<!--PHP file to handle the pushing of forms to the database. This includes registration of new users, and the handling of logging in with session creation-->

<?php

$errors = array();

if (isset($_POST['register'])) {
    // receive all input values from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $description = $_POST['description'];
    $picture = $_FILES['image']['name'];
    $target = "submitted_pictures/" . basename($picture);


    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($password != $confirmpassword) {
        array_push($errors, "The two passwords do not match");
    }


    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $result = preparequery($user_check_query);


    if (count($result) > 0) {
        if ($result[0]['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($result[0]['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        array_push($errors, "Failed to upload image");
    }


    if (count($errors) == 0) {

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user (username, password, firstname, lastname, email, description, picture) 
  			  VALUES(:username, :password, :firstname, :lastname, :email, :description, :picture)";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':picture', $picture);
        $statement->execute();
        $statement->closeCursor();
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        $mainpage = "index.php";

        header("Location: " . $mainpage);
    }
}


if (isset($_POST['login'])) {
    // receive all input values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }



    $user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";

    $result = preparequery($user_check_query);



    if (count($result) > 0) {
        if (password_verify($_POST['password'], $result[0]['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";

            $cookie_name = "usernamejs";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

            $mainpage = "index.php";

            header("Location: " . $mainpage);
            exit();
        }
    }



    if (count($errors) == 0) {
        array_push($errors, "Username or Password is incorrect");
    }
}
