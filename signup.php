<?php
// session_start();
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
    <title>Admin Register</title>
</head>

<body>
    <h1 class="text-center text-white">Welcome to Billing Management System</h1>
    <div class="container bg-light">
        <br>
        <h3 class="text-center">Admin Register!</h3>
        <br>
        <div class="container">
            <div class="container text-center">
                <form action="authentication.php" method="post">
                    <input class="form-control" type="text" name="username" placeholder="Username *" required>
                    <br>
                    <input class="form-control" type="text" name="name" placeholder="Full Name *" required>
                    <br>
                    <input class="form-control" type="text" name="mobile" placeholder="Mobile No. *" required>
                    <br>
                    <input class="form-control" type="email" name="email" placeholder="Email Address *" required>
                    <br>
                    <input class="form-control" type="text" name="address" placeholder="Present Address" required>
                    <br>
                    <input class="form-control" type="password" name="password1" placeholder="Choose Password" required>
                    <br>
                    <input class="form-control" type="password" name="password" placeholder="Confirm Password" required>
                    <br>
                    <input class="form-group btn btn-primary" name="signup" type="submit" value="Register">
                    <br>

                    <a href="login.php"><p class="text-success">Already have Account? Sign In</p></a>
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


</body>

</html>