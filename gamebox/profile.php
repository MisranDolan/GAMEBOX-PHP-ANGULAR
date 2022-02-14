<!--Front end view to display user information which is fetched from the database -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('cdn.php'); ?>
    <title>User</title>
</head>

<body>
    <div id="nav-placeholder"></div>
    <?php include 'connect-db.php'; ?>
    <?php include 'navbar.php'; ?>

    </header>

</body>

<?php if (isset($_GET['username'])) : ?>
    <?php
    $username = $_GET['username'];

    $query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closecursor();

    if (count($result) > 0) {
        $username = $result[0]["username"];
        $fullname = $result[0]["firstname"] . " " . $result[0]["lastname"];
        $picture = "./submitted_pictures/" . $result[0]["picture"];
        $description = $result[0]["description"];
        $email = $result[0]["email"];
    } else {
        echo "<h1>Page Not found<h1>";
    }

    $query = "SELECT * FROM listing WHERE owner='$username'";
    $statement = $db->prepare($query);
    $statement->execute();
    $listings = $statement->fetchAll();
    $statement->closecursor();


    ?>
<?php endif ?>
<?php if (isset($_GET['username'])) : ?>

    <div class="container content mt-5">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar position-fixed">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-picture">
                        <img src="<?php echo $picture ?>" class="profile-picture" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo ucwords($fullname); ?>
                            <div> <?php echo $description ?>
                            </div>
                            <div> <?php echo $email ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="container mt-5">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-6">Selling</h1>

                            </div>

                        </div>
                        <div class="listings">

                            <?php

                            foreach ($listings as $value) {
                                echo "<div class='card mb-5 listing'>";
                                echo "<div class='card-header'>";
                                echo "<span>" . ucwords($value["game"]) . "</span>";
                                echo "<h6 class='date'>" . $value["dateposted"] . "</h6>";
                                echo "</div>";
                                echo "<div class='row p-3'>";
                                echo "<div class='col-sm-6 col-md-4 col-lg-3 col-xl-2'>";
                                echo "<img class='listing_img' src='./submitted_pictures/" . $value["picture"] . "'>";
                                echo "</div>";
                                echo "<div class='col-sm-6 col-md-8 col-lg-9 col-xl-10'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title'>" . $value["title"] . "</h5>";
                                echo "<h6 class='price'>$" . $value["price"] . "</h6>";
                                echo "<p class='card-text'>" . $value["description"] . "</p>";
                                echo "<a href='listing.php?listing=" . $value["id"]  . "' class='btn btn-primary'>Goto Listing Page</a>";
                                echo "<form action='' method='post'>";
                                echo "<input type='hidden' id='listingid' name='listingid' value=" . $value["id"] . ">";
                                echo "<button name='edit' id='edit' value='submit' type='submit' class='mt-1 btn btn-warning'>Edit</button>";
                                echo "</form>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }

                            ?>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

</html>