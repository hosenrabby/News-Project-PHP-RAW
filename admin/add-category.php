<?php include "header.php"; 
      include "db-con.php";
      if ($_SESSION['user_role'] == 0) {
        header("location: http://localhost/NewsProject/admin/post.php");
    }
      if (isset($_POST['save'])) {
        $cat_name = $_POST['cat'];

        if ($cat_name) {
          $query = $dbcon->query("INSERT INTO `category` (`category_name`) VALUES ('$cat_name')") or die("Query Unsuccessfull");
            header("location: http://localhost/NewsProject/admin/category.php");
        }
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
