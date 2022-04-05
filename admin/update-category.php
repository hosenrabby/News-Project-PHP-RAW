<?php include "header.php"; 
      include "db-con.php";
      if ($_SESSION['user_role'] == 0) {
        header("location: http://localhost/NewsProject/admin/post.php");
      }
      $id = $_GET['id'];
      if (isset($_POST['sumbit'])) {

        $cat_name = $_POST['cat_name'];

        $query = $dbcon->query("UPDATE `category` SET `category_name` = '$cat_name' WHERE category_id = '$id'") or die("Query Unsuccessfull..");
        if ($query) {
          header("location: http://localhost/NewsProject/admin/category.php");
        } $err_masg = "Data not Updated";
      }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <?php 
              if (isset($_GET['id'])) {
                
                $query = $dbcon->query("SELECT * FROM `category` WHERE `category_id` = '$id'") or die("Query Unsuccessfull..");
                if (mysqli_num_rows($query) > 0) {
                  while($cat_data = $query->fetch_assoc()){
                    // var_dump($cat_data);
                 
               ?>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?=$cat_data['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?=$cat_data['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
                <?php 
                 }
                }
              }
                 ?>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
