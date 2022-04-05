<?php include "header.php"; 
    if ($_SESSION['user_role'] == 0) {
    header("location: http://localhost/NewsProject/admin/post.php");
  }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php 
                        include"db-con.php";
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else $page = 1;
                        $limit = 3;
                        $offset = ($page - 1) * $limit ;
                        $query = $dbcon->query("SELECT * FROM `category` LIMIT $offset, $limit") or die("Query Unsuccessfull..");

                        if (mysqli_num_rows($query) > 0) {
                            while($cat_data = $query->fetch_assoc()){
                                // var_dump($cat_data);
                           
                        ?>

                        <tr>
                            <td class='id'><?=$cat_data['category_id'] ?></td>
                            <td><?=$cat_data['category_name'] ?></td>
                            <td><?=$cat_data['post'] ?></td>
                            <td class='edit'><a href='update-category.php?id=<?=$cat_data['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?=$cat_data['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php 
                             }
                        }
                    ?>
                    </tbody>
                </table>
                <?php 
                    $query = $dbcon->query("SELECT * FROM category");

                    if (mysqli_num_rows($query) > 0) {
                        
                        $total_records = mysqli_num_rows($query);
                        $total_page = ceil($total_records / $limit);
                        
                        echo"<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo"<li><a href='category.php?page=".($page-1)."'>PREV</a></li>";
                        }
                        for ($i=1; $i <=$total_page ; $i++) { 
                            if ($i == $page) {
                               $active = "active";
                            } else $active = "";
                            echo"<li class='$active'><a href='category.php?page=$i'>$i</a></li>";
                        }
                        if ($page < $total_page) {
                            echo"<li><a href='category.php?page=".($page+1)."'>NEXT</a></li>";
                        }
                        echo"</ul>";
                    }
                ?>
                 <!-- <li><a>3</a></li> -->
                
            </div>
        </div>
    </div>
</div>
<?php 
    include_once"footer.php";
 ?>
