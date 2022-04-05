<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  <?php 
                    include"db-con.php";

                          if (isset($_GET['id'])) {
                            $post_id = $_GET['id'];
                            $query = $dbcon->query("SELECT post.post_id, post.title, post.description, category.category_name, post.post_date, user.username, user.user_id, post.category, post.post_img FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post_id = '$post_id'");
                          
                          if ($query->num_rows > 0) {
                            while ($p_data = $query->fetch_assoc()) {
                           
                   ?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?=$p_data['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?=$p_data['category']?>"><?=$p_data['category_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?au_id=<?=$p_data['user_id']?>'><?=$p_data['username']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?=$p_data['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?=$p_data['post_img']?>" alt=""/>
                            <p class="description">
                                <?=$p_data['description']?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                    <?php 
                        }
                    }
                }
            ?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
