<!--Front end view of logging into the application -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('cdn.php'); ?>


    <title>Document</title>
</head>
<?php include('connect-db.php'); ?>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="styles/signup.css">


<body>
    <?php include('form-handler.php') ?>
    <?php include('errors.php'); ?>

    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <!-- <form name="my-form" onsubmit="return validform()" action="form-handler.php" method="post"> -->
                            <form name="my-form" onsubmit="" action="" method="post">

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                    <div class="col-md-6">
                                        <input type="text" id="username" class="form-control" name="username" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" value="">
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button name="login" type=" submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>


</body>

</html>