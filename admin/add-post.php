<?php include "header.php"; 
      include "db-con.php";

      if (isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($dbcon , $_POST['post_title']);
        $desc = mysqli_real_escape_string($dbcon, $_POST['postdesc']);
        $category = mysqli_real_escape_string($dbcon , $_POST['category']);
        $date = date('d M Y');
        $author = $_SESSION['user_id'];

        if (isset($_FILES['fileUpload'])) {
           $errors = [];
           $file_name = $_FILES['fileUpload']['name'];
           $file_tmpname = $_FILES['fileUpload']['tmp_name'];
           $file_type = $_FILES['fileUpload']['type'];
           $file_size = $_FILES['fileUpload']['size'];
           $file_ext = explode('.', $file_name);
           $file_extention = strtolower(end($file_ext));
           $extentions = ["jpeg","jpg","png"];
           $file_name = substr($title,1,8) .".". $file_extention ;

             if (in_array($file_extention, $extentions) === true) {
             if ($file_size < 2097152) {
               if (empty($errors)) {

                  $sql = "INSERT INTO `post`(`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('$title','$desc','$category','$date','$author','$file_name');";
                  $sql .= "UPDATE `category` SET `post`= post + 1 WHERE category_id = '$category'" or die("Query Unsuccessfull.");
                  // var_dump($sql);
                  $query = $dbcon->multi_query($sql);
                    if ($query) {
                      move_uploaded_file($file_tmpname, "upload/".$file_name);
                      header("location: http://localhost/NewsProject/admin/post.php"); }
               } else $errors[] = "Post Not Uploded, Sumthing is Missing.";
             } else $errors[] = "File size need to Lower than 2 MB or equal.";
           } else $errors[] = "Extention Dos'nt metch, Plese be sure your file is JPG or PNG.";
           
        }
      }
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                      <?php 
                        if (!empty($errors)) :
                          foreach ($errors as $error_key => $error_value) : ?>
                           <div class="alert alert-danger text-center"><?=$error_value ?></div>
                        <?php 
                          endforeach;
                        endif;
                      ?>
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>

                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="postdesc"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="category">Category</label>
                          <select name="category" class="form-control" required>
                              <option value="" selected> Select your post category must </option>
                              <?php 
                                include"db-con.php";

                                $query = $dbcon->query("SELECT * FROM category");
                                if ($query->num_rows > 0) {
                                  while($cat_data = $query->fetch_assoc()){
                                    echo "<option value='{$cat_data['category_id']}'>{$cat_data['category_name']}</option>";
                                  }
                                }
                             ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="fileUpload">Post image</label>
                          <input type="file" name="fileUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                      
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
