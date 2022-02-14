<!--Front end view of a game listing which includes functionality to fetch game information from the database as well as pushing game information to your cart -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('cdn.php'); ?>

    <title>Gamebox</title>
</head>

<body>

    <header>
        <div id="nav-placeholder"></div>
        <?php include 'connect-db.php'; ?>
        <?php include 'navbar.php'; ?>
        <?php
        try {
            $listing_id = $_GET['listing'];
            $query = "SELECT * FROM listing WHERE id='$listing_id' LIMIT 1";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closecursor();

            if (count($result) > 0) {
                $title = $result[0]["title"];
                $condition = $result[0]["game_condition"];
                $picture = $result[0]["picture"];
                $picture2 = $result[0]["picture2"];
                $picture3 = $result[0]["picture3"];
                $description = $result[0]["description"];
                $owner = $result[0]["owner"];
                $game = $result[0]["game"];
                $console = $result[0]["console"];
                $location = $result[0]["location"];
                $price = $result[0]["price"];
                $date_posted = $result[0]["dateposted"];
                $count = 1;

                if ($picture2 != "") {
                    $count += 1;
                    if ($picture3 != "") {
                        $count += 1;
                    }
                }
            } else {
                echo "<h1>Listing Not found<h1>";
            }
        } catch (Exception $e) {
            echo "<h1>" . $e . "</h1>";
        }

        if (isset($_POST['add_cart'])) {
            $username = $_POST['username'];
            $listingid = $_GET['listing'];

            $query = "SELECT * FROM shoppingcart WHERE username='$username' AND listingid='$listingid' LIMIT 1";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closecursor();

            if (count($results) == 0) {
                $query = "INSERT INTO shoppingcart (username, listingid) VALUES (:username, :listingid)";

                $statement = $db->prepare($query);
                $statement->bindValue(':username', $username);
                $statement->bindValue(':listingid', $listingid);
                $statement->execute();
                $statement->closeCursor();
            }


            $mainpage = "shopping_cart.php";

            header("Location: " . $mainpage);
        }


        ?>
    </header>

    <?php if (isset($_SESSION['username'])) : ?>
        <div class="container mt-5">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="col-md-auto">
                        <h1 class="card-title"><?php echo $title ?></h1>
                    </div>


                    <div class="row p-3">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <img class="listing_img" src="submitted_pictures/<?php echo ($picture) ?>">
                        </div>
                        <div class=" col-sm-6 col-md-8 col-lg-9 col-xl-10" style="border:1px solid gray">
                            <div class="card-body">
                                <h5 class="card-text">Seller: <a href="profile.php?username=<?php echo $owner ?>"><?php echo $owner ?></a></h5>
                                <h5 class="card-text">Game: <?php echo ucwords($game) ?></h5>
                                <h5 class="card-text">Console: <?php echo ucwords($console) ?></h5>
                                <h5 class="card-text">Condition: <?php echo ucwords($condition) ?></h5>
                                <h5 class="price">Price: $<?php echo $price ?></h5>
                                <h5 class="card-text">Location: <?php echo ucwords($location) ?></h5>
                                <h5 class="card-text">Description: <?php echo $description ?></h5>
                                <h6 class="date">Date Submitted: <?php echo $date_posted ?></h6>
                                <div class="btn-toolbar">
                                    <a href="#" class="btn btn-primary mr-2" onclick="error_click()" id="buybtn">Buy Now</a>
                                    <br />
                                    <form name="my-form" id="listing-button-form" action="" method="post">
                                        <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username'] ?>">
                                        <button name="add_cart" id="add_cart" value="submit" type="submit" class="btn btn-primary">Add to Shopping Cart</button>
                                    </form>
                                    <br />
                                    <span class="card-text" id="error" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                </div>

                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <!-- SLIDER WITH INDICATORS -->
                        <div id="slider3" class="carousel slide mb-5" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#slider3" data-slide-to="0"></li>
                                <?php if ($count > 1) : ?>
                                    <li data-target="#slider3" data-slide-to="1"></li>
                                <?php endif ?>
                                <?php if ($count > 2) : ?>
                                    <li data-target="#slider3" data-slide-to="2"></li>
                                <?php endif ?>

                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="post_img" src="./submitted_pictures/<?php echo $picture ?>" alt="First Slide">
                                </div>
                                <?php if ($count > 1) : ?>
                                    <div class="carousel-item">
                                        <img class="post_img" src="./submitted_pictures/<?php echo $picture2 ?>" alt="Second Slide">
                                    </div>
                                <?php endif ?>
                                <?php if ($count > 2) : ?>
                                    <div class="carousel-item">
                                        <img class="post_img" src="./submitted_pictures/<?php echo $picture3 ?>" alt="Third Slide">
                                    </div>
                                <?php endif ?>
                            </div>

                            <!-- CONTROLS -->
                            <a href="#slider3" class="carousel-control-prev" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>

                            <a href="#slider3" class="carousel-control-next" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>


    <?php include('scripts.php'); ?>
    <script src="./scripts/listing_page.js"></script>
</body>

</html>