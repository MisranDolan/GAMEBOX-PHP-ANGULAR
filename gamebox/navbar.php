<!--Front end view of the navbar which directs the user to other views of the application -->

<?php
session_start();
?>
<?php include 'connect-db.php'; ?>

<?php
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    $mainpage = "index.php";
    header("Location: " . $mainpage);
}

function preparequery($query)
{
    global $db;
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closecursor();

    return $results;
}
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark shadow-lg large-nav">
    <div class="container-fluid">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li>
                <form action="results.php" method="get">
                    <div class="input-group ml-5">
                        <input type="search" name="search" id="navsearch" placeholder="What're you searching for?" class="form-control bg-secondary">
                        <div class="input-group-append">
                            <button type="submit" class="btn bg-secondary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['username'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php?username=<?php echo $_SESSION['username']; ?>">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_listing.php">Sell</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shopping_cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout='1'">Logout</a>
                </li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['username'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Sign up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark shadow-lg small-nav">
    <div class="container-fluid justify-content-center align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php if (!isset($_SESSION['username'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Sign up</a>
                </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php?username=<?php echo $_SESSION['username']; ?>">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout='1'">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_listing.php">Sell</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <form action="results.php">
                    <div class="input-group">
                        <input type="search" id="navsearch" placeholder="What're you searching for?" class="form-control bg-secondary">
                        <div class="input-group-append">
                            <button type="submit" class="btn bg-secondary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>