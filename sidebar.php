<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search News title</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
    <?php 
        include"db-con.php";
                $limit = 5 ;

                $query = $dbcon->query("SELECT post.post_id, post.title, post.post_date, post.post_img, category.category_id, category.category_name FROM post LEFT JOIN category ON post.category = category.category_id ORDER BY post.post_id DESC LIMIT $limit ");
                          
                if (mysqli_num_rows($query) > 0) {
                    }while ($rec_post = $query->fetch_assoc()) {
                        // var_dump($rec_post);
            ?>
        <div class="recent-post">
            <a class="post-img" href="">
                <img src="admin/upload/<?=$rec_post['post_img']?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?=$rec_post['post_id']?>"><?=$rec_post['title']?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href="category.php?cid=<?=$rec_post['category_id']?>"><?=$rec_post['category_name']?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?=$rec_post['post_date']?>
                </span>
                <a class="read-more" href="single.php?id=<?=$rec_post['post_id']?>">Read more</a>
            </div>
        </div>
        <?php 
        }
     ?>
    </div>
    <!-- /recent posts box -->
</div>
