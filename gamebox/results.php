<!--Front end view to display all results of a game search performed by a user -->
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
        <?php include('navbar.php'); ?>

    </header>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $game = strtolower($_GET['search']);


        $query = "SELECT * FROM listing WHERE game like '%$game%'";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closecursor();
    }
    ?>
    <div class="container mt-5">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-6">Results for <?php echo $game  ?></h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas recusandae
                    voluptatibus, natus
                    architecto asperiores
                    a.
                </p>
            </div>

        </div>

        <div class="form-group">
            Sort By:
            <select class="custom-select sort_option" name="sort_option">
                <option value=""></option>
                <option value="lowest">Price (Lowest First)</option>
                <option value="highest">Price (Highest First)</option>
                <option value="newest">Newest Listing</option>
                <option value="oldest">Oldest Listing</option>
            </select>
        </div>
        <div class="listings">

            <?php

            foreach ($results as $value) {
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
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            ?>

        </div>



    </div>
    <?php include('scripts.php'); ?>
    <script src="./scripts/listings.js"></script>
</body>

</html>