<!--Front end view to shopping cart information which is fetched from the database -->
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

    </header>

    <?php if (isset($_SESSION['username'])) : ?>

        <?php

        if (isset($_POST['delete_cart'])) {
            $listingid = $_POST['listingid'];
            $username = $_SESSION['username'];

            $query = "DELETE FROM shoppingcart WHERE username='$username' AND listingid='$listingid'";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closecursor();
        }

        $username = $_SESSION['username'];
        $query = "SELECT * FROM shoppingcart WHERE username='$username'";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closecursor();

        $listings = array();

        foreach ($results as $shopping_cart_item) {
            $listingid = $shopping_cart_item["listingid"];
            $query = "SELECT * FROM listing WHERE id='$listingid'";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closecursor();
            array_push($listings, $results[0]);
        }


        ?>
    <?php endif ?>

    <div class="container mt-5">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-6">Shopping Cart</h1>

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
                echo "<button name='delete_cart' id='delete_cart' value='submit' type='submit' class='mt-1 btn btn-warning'>Delete from Cart</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            ?>

        </div>



    </div>


    <?php include('scripts.php'); ?>

</body>

</html>