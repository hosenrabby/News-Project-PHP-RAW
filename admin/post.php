<?php include "header.php";?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php 
                          include"db-con.php";

                          if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                          } else $page = 1;

                          $limit = 4 ;
                          $offset = ($page - 1) * $limit;

                          if ($_SESSION['user_role'] == 1) {
                              $query = $dbcon->query("SELECT post.post_id, post.title, post.description, category.category_name, post.post_date, user.username, post.category FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT $offset , $limit");
                            } else{
                              $query = $dbcon->query("SELECT post.post_id, post.title, post.description, category.category_name, post.post_date, user.username, post.category FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['user_id']} ORDER BY post.post_id DESC LIMIT $offset , $limit");
                            }
                          
                          if (mysqli_num_rows($query) > 0) {
                            $serial = $offset +1 ;
                            while ($p_data = $query->fetch_assoc()) { 
                         ?>
                      <tbody>
                          <tr>
                              <td class='id'><?=$serial ?></td>
                              <td><?=$p_data['title']?></td>
                              <td><?=$p_data['category_name']?></td>
                              <td><?=$p_data['post_date']?></td>
                              <td><?=$p_data['username']?></td>
                              <td class='edit'><a href="update-post.php?post_id=<?=$p_data['post_id']?>"><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?post_id=<?=$p_data['post_id']?>&cat_id=<?=$p_data['category']?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                            $serial++;
                           }
                          }
                      ?>
                      </tbody>
                  </table>
                  <?php 
                    if ($_SESSION['user_role'] == 1) {
                      $query = $dbcon->query("SELECT * FROM post");
                    } else {
                      $query = $dbcon->query("SELECT * FROM post LEFT JOIN user ON post.author = user.user_id WHERE post.author = {$_SESSION['user_id']}");
                    }
                    if (mysqli_num_rows($query) > 0) {
                      $total_records = mysqli_num_rows($query);
                      $total_page = ceil($total_records / $limit);

                      echo "<ul class='pagination admin-pagination'>";
                      if ($page > 1) {
                        echo "<li><a href='post.php?page=".($page-1)."'>PREV</a></li>";
                      }
                      for ($i=1; $i <= $total_page ; $i++) {
                        if ($i == $page) {
                          $active = "active";
                        } else $active = "";

                        echo "<li class='$active'><a href='post.php?page=$i' > $i </a></li>";
                      }
                      if ($total_page > $page) {
                        echo "<li><a href='post.php?page=".($page+1)."'>NEXT</a></li>";
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
