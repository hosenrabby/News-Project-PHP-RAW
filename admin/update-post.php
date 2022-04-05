<?php include "header.php"; 
      include "db-con.php";

      if ($_SESSION['user_role'] == 0) {
        $_GET['post_id'];
        $post_id = $_GET['post_id'];
        $query = $dbcon->query(" SELECT author FROM post WHERE post_id = '$post_id' ");
        $result = $query->fetch_assoc();
        if ($_SESSION['user_id'] != $result['author']) {
           header("location: http://localhost/NewsProject/admin/post.php"); 
        }
      }
      if (isset($_POST['submit'])) {
        $post_id = $_POST['post_id'];
        $title = mysqli_real_escape_string($dbcon , $_POST['post_title']);
        $desc = mysqli_real_escape_string($dbcon, $_POST['post_desc']);
        $category = mysqli_real_escape_string($dbcon , $_POST['category']);

        if (empty($_FILES['new_image']['name'])) {
            $file_name = $_POST['old_image'];
            $file_tmpname = $_FILES['new_image']['tmp_name'];
            $file_type = $_FILES['new_image']['type'];
            $file_size = $_FILES['new_image']['size'];
            $file_ext = explode('.', $file_name);
            $file_extention = strtolower(end($file_ext));
            $extentions = ["jpeg","jpg","png"];
            $file_name = substr($title,1,8) .".". $file_extention ;
        } else {
           $file_name = $_FILES['new_image']['name'];
           $file_tmpname = $_FILES['new_image']['tmp_name'];
           $file_type = $_FILES['new_image']['type'];
           $file_size = $_FILES['new_image']['size'];
           $file_ext = explode('.', $file_name);
           $file_extention = strtolower(end($file_ext));
           $extentions = ["jpeg","jpg","png"];
           $file_name = substr($title,1,8) .".". $file_extention ;
        }
        if (isset($_FILES['new_image'])) {
            if (in_array($file_extention, $extentions) === true) {
             if ($file_size < 2097152) {
               if (empty($errors)) {
                $sql = "UPDATE `post` SET`title`='$title',`description`='$desc',`category`='$category',`post_img`='$file_name' WHERE post_id = '$post_id';";
                if ($_POST['old_category'] != $_POST['category']) {
                    $sql .="UPDATE `category` SET `post`= post - 1 WHERE category_id = {$_POST['old_category']};";
                    $sql .= "UPDATE `category` SET `post`= post + 1 WHERE category_id = {$_POST['category']}" or die("Query Unsuccessfull.");
                }
                  $query = $dbcon->multi_query("$sql") or die("Query Unsuccessfull.");
                    if ($query) {
                      move_uploaded_file($file_tmpname, "upload/".$file_name);
                      header("location: http://localhost/NewsProject/admin/post.php"); 
                    }
               } else echo "Post Not Updated, Sumthing is wrong.";
             } else $errors[] = "File size need to Lower than 2 MB or equal.";
           } else $errors[] = "Extention Dos'nt metch, Plese be sure your file is JPG or PNG.";
           
        }
      }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php 
            if (isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];

                $query = $dbcon->query("SELECT post.post_id, post.title, post.description,post.category, post.post_img, category.category_name,category.category_id FROM post LEFT JOIN category ON post.category = category.category_id WHERE post.post_id = $post_id ");
                if ($query->num_rows > 0) {
                    while($post_data = $query->fetch_assoc()){

         ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?=$post_data['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?=$post_data['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="post_desc" class="form-control"  required rows="5"><?=$post_data['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php
                        $query = $dbcon->query("SELECT * FROM category");
                            if ($query->num_rows > 0) {
                                while($cat_data = $query->fetch_assoc()){
                                    if ($post_data['category'] == $cat_data['category_id']) {
                                        $selected = "selected";
                                    } else $selected = "";
                                    echo "<option $selected value='{$cat_data['category_id']}'>{$cat_data['category_name']}</option>";
                                  }
                                }
                             ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="old_category"  class="form-control" value="<?=$post_data['category_id'] ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new_image">
                <img  src="upload/<?=$post_data['post_img'] ?>" height="150px">
                <input type="hidden" name="old_image" value="<?=$post_data['post_img'] ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php 
                    }
                } else echo "Data not found.";
            }
         ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>