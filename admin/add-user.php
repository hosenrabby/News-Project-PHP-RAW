<?php include "header.php";
  include "db-con.php";
  if ($_SESSION['user_role'] == 0) {
    header("location: http://localhost/NewsProject/admin/post.php");
  }
  if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
    $lname = mysqli_real_escape_string($dbcon, $_POST['lname']);
    $uname = mysqli_real_escape_string($dbcon, $_POST['uname']);
    $password = mysqli_real_escape_string($dbcon, $_POST['password']);
    $role = mysqli_real_escape_string($dbcon, $_POST['role']);
     
    if (isset($uname)) {
      $check_uname = $dbcon->query("SELECT * FROM user WHERE username = '$uname' ") or die("query unsuccesful,");
      if (mysqli_num_rows($check_uname) == 0) {
        if (strlen($password) > 7) {
          $password = md5($password);
          $query = $dbcon->query("INSERT INTO `user`(`first_name`, `last_name`, `username`, `password`, `role`) VALUES ('$fname' , '$lname' , '$uname' , '$password' , '$role')");
          if ($query) {
            header("location: http://localhost/NewsProject/admin/users.php");
          } else { $data_err = "Cun't Add user Right now.";}
        }  else { $pass_err = "Passowrd Need to be more then 8 charecter."; }
      } else { $uname_err = "This username Already exiest ."; } 
  }
}
?> 
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading text-center">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php if (isset($uname_err)): ?>
                  <div class="alert alert-danger text-center"><?=$uname_err ?> </div>
                <?php endif; ?>

                <?php if (isset($pass_err)) :?>
                  <div class="alert alert-danger text-center"><?=$pass_err ?></div>
                <?php endif; ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="uname" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Sub Admin</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Submit" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
