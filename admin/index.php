<?php 
    include "db-con.php";
    session_start();
    if (isset($_SESSION['username'])) {
        header("location: http://localhost/NewsProject/admin/post.php");
    }
    if (isset($_POST['login'])) {
        $errors = [];
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = mysqli_real_escape_string($dbcon , $_POST['username']);
            $password = md5($_POST['password']);

            $check_uname = $dbcon->query("SELECT * FROM user WHERE username = '$username'");
            if ($check_uname->num_rows > 0) {
                $pass_check = $check_uname->fetch_assoc();
                if ($pass_check['password'] == $password) {
                    $query = $dbcon->query("SELECT `user_id`, `username`, `role` FROM `user` WHERE `username` = '$username' AND `password` = '$password'") or die("Query Unsuccessfull..");
                    if ($query->num_rows > 0) {
                        $user_data = $query->fetch_assoc();
                        $_SESSION['user_id'] = $user_data['user_id'];
                        $_SESSION['username'] = $user_data['username'];
                        $_SESSION['user_role'] = $user_data['role'];
                        
                        header("location: http://localhost/NewsProject/admin/post.php");
                      }
                } else $errors[] = "Your Password is Incorrect ";
            } else $errors[] = "Dont find any kind of username like this. ";
        } else  $errors[] = "Type your username or password.";
    }
    
 ?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <?php 
                        if (!empty($errors)):
                            foreach ($errors as $error_key => $error_value):?>
                                <div class="col-md-2"></div>
                                <div class="col-md-8"><h4 class="alert alert-danger text-center" style="display:block;"><?=$error_value ?></h4></div>
                                <div class="col-md-2"></div>
                     <?php 
                        endforeach;
                    endif;
                      ?>
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" >
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" >
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="Login" />
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
