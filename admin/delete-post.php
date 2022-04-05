<?php 
    include "db-con.php";
    if ($_SESSION['user_role'] == 0) {
    header("location: http://localhost/NewsProject/admin/post.php");
  }
    if (isset($_GET['post_id'])) {
      $post_id = $_GET['post_id'];
      $cat_id = $_GET['cat_id'];
      $query = $dbcon->query("SELECT * FROM `post` WHERE post_id = $post_id") or die("Query Unsuccessfull.");
      if ($query->num_rows > 0) {
        while($result = $query->fetch_assoc()){
          unlink("upload/".$result['post_img']);
        }
      } 
      $sql = "DELETE FROM `post` WHERE post_id = $post_id ;";
      $sql .= "UPDATE `category` SET `post`= post - 1 WHERE category_id = '$cat_id'" or die("Query Unsuccessfull.");
    $query = $dbcon->multi_query($sql);
       if ($query) {
         header("location: http://localhost/NewsProject/admin/post.php");
         } else $err_masg = "Data Not Deleted ..";
       }
 ?>