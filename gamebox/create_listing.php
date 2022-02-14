<!--Front end view for creating a listing, this includes forms for user details and game specifications -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/mobile.css">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <script src="//code.jquery.com/jquery.min.js"></script> -->

    <title>Gamebox</title>
</head>

<?php include('connect-db.php'); ?>
<?php include('navbar.php'); ?>


<body>
    <?php include('listing-handler.php') ?>
    <?php include('errors.php'); ?>

    <?php if (isset($_SESSION['username'])) : ?>
        <div class="container mt-5">
            <!-- <form> -->
            <form name="my-form" id="listing-form" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="owner" name="owner" value="<?php echo $_SESSION['username'] ?>">

                <div class="form-group">
                    <label>Title</label>
                    <input type="input" class="form-control" id="title" name="title">
                    <div id="title_warning" class="warning">Title must have at least 8 characters</div>
                </div>
                <div class="form-group">
                    <label for="game">Game</label>
                    <input type="input" class="form-control" id="game" name="game">
                    <div id="game_warning" class="warning">Game Title must have at least 1 characters</div>
                </div>
                <div class="form-group">
                    <label for="game">Location</label>
                    <input type="input" class="form-control" id="location" name="location">
                    <div id="location_warning" class="warning">Location cannot be empty</div>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="input" class="form-control" id="price" name="price">
                    <div id="price_warning" class="warning">Price must be valid currency format Ex. 10.50</div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Condition</label>
                    <select class="form-control" id="condition" name="condition">
                        <option>New</option>
                        <option>Used</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Console">Console</label>
                    <select class="form-control" id="console" name="console">
                        <option></option>
                        <option>PS4</option>
                        <option>Nintendo Switch</option>
                        <option>Xbox One</option>
                        <option>PC</option>
                        <option>PS3</option>
                        <option>Xbox 360</option>
                        <option>WII U</option>
                        <option>WII</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows=" 3"></textarea>
                    <p>Number of characters: <span id="length_description">0</span></p>
                    <div id="description_warning" class="warning">Description must be less than 1000 characters</div>
                </div>
                <div class="form-group">
                    <label for="picture">Upload Photo</label>
                    <input type="file" class="form-control-file" name="image[]" id="photo" multiple>
                </div>
                <button name="submit_listing" id="submit_listing" value="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    <?php endif ?>

    <?php if (!isset($_SESSION['username'])) : ?>
        <h1> Please login </h1>
    <?php endif ?>

    <?php include('scripts.php'); ?>

    <script src="./scripts/create_listing.js"></script>
</body>

</html>