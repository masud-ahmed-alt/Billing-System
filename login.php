<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/logincss.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/logincss.css">

    <!-- JQUERY -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <title>Login Admin</title>
</head>

<body>
    <h1 class="text-center text-white">Welcome to Billing Management System</h1>
    <div class="container bg-light"  style="border-radius:10px">
        <br>
        <h1 class="text-center">Admin Login!</h1>
        <br>
        <div class="container">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-6">
                    <form action="authentication.php" method="post">
                    <input class="form-control" type="text" name="username" placeholder="Username">
                    <br>
                    <input class="form-control" type="password" name="password" placeholder="Confirm Password">
                    <br>
                    <input class="form-group btn btn-primary pl-3 pr-3" type="submit" name="login" value="Login">
                    <br>

                    <a href="signup.php"><p class="text-success">Create new Account?</p></a>

                    <p class="text-danger">
                        <?php 
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset ($_SESSION['msg']);
                        }
                        ?>
                    </p>
                </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>