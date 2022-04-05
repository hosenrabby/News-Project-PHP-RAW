<?php include "header.php";
  if ($_SESSION['user_role'] == 0) {
    header("location: http://localhost/NewsProject/admin/post.php");
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <?php if (isset($err_masg)): ?>
                  <div class="alert alert-danger text-center"><?=$err_masg ?> </div>
                <?php endif; ?>
              
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                          include"db-con.php";

                          if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                          } else $page = 1;

                          $limit = 4 ;
                          $offset = ($page - 1) * $limit;

                          $query = $dbcon->query("SELECT * FROM user ORDER BY user_id DESC LIMIT $offset , $limit");
                          if (mysqli_num_rows($query) > 0) {
                            $serial = $offset + 1;
                            while ($udata = $query->fetch_assoc()) {
                         ?>
                          <tr>
                              <td class='id'><?=$serial?></td>
                              <td><?=$udata['first_name']." ". $udata['last_name']?></td>
                              <td class="text-center"><?=$udata['username']?></td>
                              <td>
                                <?php 
                                  if ($udata['role'] == 1) {
                                    echo "Admin";
                                  } else echo "Sub Admin";
                                 ?>
                              </td> 
                              <td class='edit'><a href='update-user.php?id=<?=$udata['user_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?=$udata['user_id']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                          $serial++;
                           }
                          }
                      ?>
                      </tbody>
                  </table>
                  <?php 
                    $query = $dbcon->query("SELECT * FROM user");

                    if (mysqli_num_rows($query) > 0) {
                      $total_records = mysqli_num_rows($query);
                      $total_page = ceil($total_records / $limit);

                      echo "<ul class='pagination admin-pagination'>";
                      if ($page > 1) {
                        echo "<li><a href='users.php?page=".($page-1)."'>PREV</a></li>";
                      }
                      for ($i=1; $i <= $total_page ; $i++) {
                        if ($i == $page) {
                          $active = "active";
                        } else $active = "";

                        echo "<li class='$active'><a href='users.php?page=$i' > $i </a></li>";
                      }
                      if ($total_page > $page) {
                        echo "<li><a href='users.php?page=".($page+1)."'>NEXT</a></li>";
                      }
                      echo "</ul>";
                    }
                   ?>
                    <!-- <li><a href="users.php?page=($page - 1)" >PREV</a></li> -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
