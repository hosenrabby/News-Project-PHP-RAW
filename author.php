<?php include 'header.php'; ?>
<div id="main-content">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- post-container -->
        <div class="post-container">
          <?php
          if (isset($_GET['au_id'])) {
            $author = $_GET['au_id'];
          }
          $query = $dbcon->query("SELECT username FROM user WHERE user_id = '$author'");
          $cat_name = $query->fetch_assoc();
          ?>
          <h2 class="page-heading"><?= ucfirst($cat_name['username']) ?></h2>
          <?php
          include "db-con.php";

          if (isset($_GET['page'])) {
            $page = $_GET['page'];
          } else $page = 1;

          $limit = 4;
          $offset = ($page - 1) * $limit;

          $query = $dbcon->query("SELECT post.post_id, post.title, post.description, category.category_name, post.post_date, user.username, user.user_id, post.category, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE user.user_id = '$author' ORDER BY post.post_id DESC LIMIT $offset , $limit");

          if (mysqli_num_rows($query) > 0) {
            while ($p_data = $query->fetch_assoc()) {
          ?>
              <div class="post-container">
                <div class="post-content">
                  <div class="row">
                    <div class="col-md-4">
                      <a class="post-img" href="single.php?id=<?= $p_data['post_id'] ?>"><img src="admin/upload/<?= $p_data['post_img'] ?>" alt="" /></a>
                    </div>
                    <div class="col-md-8">
                      <div class="inner-content clearfix">
                        <h3><a href='single.php?id=<?= $p_data['post_id'] ?>'><?= $p_data['title'] ?></a></h3>
                        <div class="post-information">
                          <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cid=<?= $p_data['category'] ?>'><?= $p_data['category_name'] ?></a>
                          </span>
                          <span>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <a href='author.php?au_id=<?= $p_data['user_id'] ?>'><?= $p_data['username'] ?></a>
                          </span>
                          <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?= $p_data['post_date'] ?>
                          </span>
                        </div>
                        <p class="description">
                          <?= substr($p_data['description'], 0, 130) . "...." ?>
                        </p>
                        <a class='read-more pull-right' href='single.php?id=<?= $p_data['post_id'] ?>'>read more</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end post container -->
          <?php
            }
          }
          $query = $dbcon->query("SELECT author FROM post WHERE author = '$author'");
          if (mysqli_num_rows($query) > 0) {
            $total_records = mysqli_num_rows($query);
            $total_page = ceil($total_records / $limit);
            $p_data = $query->fetch_assoc();

            echo "<ul class='pagination admin-pagination'>";
            if ($page > 1) {
              echo "<li><a href='author.php?au_id=" . $author . "&page=" . ($page - 1) . "'>PREV</a></li>";
            }
            for ($i = 1; $i <= $total_page; $i++) {
              if ($i == $page) {
                $active = "active";
              } else $active = "";

              echo "<li class='$active'><a href='author.php?au_id=" . $author . "&page=$i' > $i </a></li>";
            }
            if ($total_page > $page) {
              echo "<li><a href='author.php?au_id=" . $author . "&page=" . ($page + 1) . "'>NEXT</a></li>";
            }
            echo "</ul>";
          }
          ?>
        </div><!-- /post-container -->
      </div>
      <?php include 'sidebar.php'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>