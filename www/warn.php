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
            <div class="container body">
                <div class="row">
                    <div id="pop-col" class="col-sm-12">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3 style="color: red;">WARNING</h3>
                            </div>
                            <div class="basic-box-body posts-box featured-box">
                                <?php if(isset($_GET['case'])){
                                    if($_GET['case'] == 1){
                                    ?>
                                        <h3>Do not try to SQL inject this site.</h3>
                                        <p>do you think i'm that stupid to leave this site vulnerable to attacks? common dont try my patience.</p>
                                        <p>go attack someone else if you have nothing better to do.</p>
                                    <?php
                                    }
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
   </div>
</body>
</html>