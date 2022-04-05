<?php 
    include "db-con.php";
    $page_title = (basename($_SERVER['PHP_SELF']));
    switch ($page_title) {
        case 'single.php':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                   $query = $dbcon->query("SELECT * FROM post WHERE post_id = '$id'") or die("Query Unsuccessfull | Title");
                   $title = $query->fetch_assoc();
                   $page_fl_name = $title['title'];
                } else echo "No Post Found";
            break;
        case 'category.php':
                if (isset($_GET['cid'])) {
                    $cid = $_GET['cid'];
                   $query = $dbcon->query("SELECT * FROM category WHERE category_id = '$cid'") or die("Query Unsuccessfull | Title");
                   $title = $query->fetch_assoc();
                   $page_fl_name = ucfirst($title['category_name']) . " | News";
                } else echo "No Post Found";
            break;
        case 'author.php':
                if (isset($_GET['au_id'])) {
                    $au_id = $_GET['au_id'];
                   $query = $dbcon->query("SELECT * FROM user WHERE user_id = '$au_id'") or die("Query Unsuccessfull | Title");
                   $title = $query->fetch_assoc();
                   $page_fl_name = ucfirst($title['username']) . " | News";
                } else echo "No Post Found";
            break;
        case 'search.php':
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                   $page_fl_name = $search . " | News";
                } else echo "No search result Found";
            break;
        default:
             $page_fl_name = "News | Blogs";
            break;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$page_fl_name?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div> 
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu' style="display: contents;">
                    <li><a href='index.php'>News feed</a></li>
                <?php 
                    include "db-con.php";
                    $query = $dbcon->query("SELECT * FROM category WHERE post > 0 ") or die("Query Unsuccessfull ..");
                    if ($query->num_rows > 0) {
                        while($result = $query->fetch_assoc()){
                            $active = "";
                            if (isset($_GET['cid'])) {
                                $cat_id = $_GET['cid'];
                                if ($result['category_id'] == $cat_id) {
                                    $active = "active";
                                } else $active = "";
                            }
                            echo "<li ><a class='{$active}' href='category.php?cid={$result['category_id']}'>{$result['category_name']}</a></li>";
                        }
                    }
                 ?>
                  </ul>
                <!-- <ul class='menu'>
                    <li><a href='category.php'>Business</a></li>
                    <li><a href='category.php'>Entertainment</a></li>
                    <li><a href='category.php'>Sports</a></li>
                    <li><a href='category.php'>Politics</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
