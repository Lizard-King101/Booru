<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'imports/jquery.php';?>
    <?php include 'imports/bootstrap.php';?>
    <?php include 'imports/fontawesome.php';?>
    <?php include 'imports/global.php';?>
    <script src="js/home.js"></script>
</head>
<body>
   <div id="body-wrap">
        <div id="nav-box">
            <?php include 'side-nav.php';?>
        </div>
        <div id="body-box">
           <?php include 'navbar.php';?>
            <div class="container body">
              	<?php include "imports/page_notifications.php"; ?>
                <div class="row">
                    <div id="pop-col" class="col-md-3 col-sm-6">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3>Featured Posts</h3>
                            </div>
                            <div class="row basic-box-body posts-box featured-box">
                            </div>
                        </div>
                    </div>
                    <div id="main-col" class="col-md-9 col-sm-6">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="row basic-box-body posts-box latest-box">
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
   </div>
</body>
</html>