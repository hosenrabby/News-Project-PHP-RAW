<?php include "header.php"; 
      include "db-con.php";
      if ($_SESSION['user_role'] == 0) {
         header("location: http://localhost/NewsProject/admin/post.php");
      }
      if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $user_id = mysqli_real_escape_string($dbcon, $_POST['user_id']);
        $fname = mysqli_real_escape_string($dbcon, $_POST['f_name']);
        $lname = mysqli_real_escape_string($dbcon, $_POST['l_name']);
        $uname = mysqli_real_escape_string($dbcon, $_POST['username']);
        $role = mysqli_real_escape_string($dbcon, $_POST['role']);
           
            $query = $dbcon->query("UPDATE `user` SET `user_id`= '$user_id',`first_name`= '$fname',`last_name`='$lname',`username`='$uname',`role`='$role' WHERE user_id = '$id'");
              // var_dump($query);
              if ($query) {
                header("location: http://localhost/NewsProject/admin/users.php");
              } else { $data_err = "Cun't Add user Right now.";}
            }
    

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading text-center">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php 
                  if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = $dbcon->query("SELECT * FROM `user` WHERE `user_id` = '$id'");
                    if (mysqli_num_rows($query) > 0 ) {
                      while($result = $query->fetch_assoc()){   
                  ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control"value="<?=$result['user_id']?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?=$result['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?=$result['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?=$result['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?=$row['role']; ?>">
                              <?php if ($result['role'] == 1) {
                                echo "<option value='0'>Sub Admin</option>";
                                echo "<option value='1' SELECTED>Admin</option>";
                              } else {
                                echo "<option value='0' SELECTED >Sub Admin</option>";
                                echo "<option value='1' >Admin</option>";
                              }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->

                  <?php 
                      }
                    } else { $error_m = "Data found error..";}
                  } 
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
