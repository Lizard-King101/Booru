<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'imports/jquery.php';?>
    <?php include 'imports/bootstrap.php';?>
    <?php include 'imports/fontawesome.php';?>
    <?php include 'imports/global.php';?>
</head>
<body>
    <div id="body-wrap">
        <div id="nav-box">
            <?php include 'side-nav.php';?>
        </div>
        <div id="body-box">
           <?php include 'navbar.php';?>
            <div class="container">
              	<?php include "imports/page_notifications.php"; ?>
                <div class="row">
                    <div id="main-col" class="col-sm-12">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3>Account Settings</h3>
                            </div>
                            <div class="basic-box-body">
                                Test
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</body>
</html>