<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'imports/jquery.php';?>
        <?php include 'imports/bootstrap.php';?>
        <?php include 'imports/fontawesome.php';?>
        <?php include 'imports/global.php';?>
        <link rel="stylesheet" href="css/admin.css">
        <script src="js/adminManager.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    </head>
    <body>
       <div id="body-wrap">
            <div id="nav-box">
                <?php include 'side-nav.php';?>
            </div>
            <div id="body-box">
               <?php include 'navbar.php';?>
                <div class="basic-box admin-container">
                    <div class="basic-box-head admin">
                        <h3>Administrion</h3>
                        <ul class="list il">
                            <li class="list-item"><a href="javascript:{}" onClick="adminLoad('users');"><i class="fa fa-users"></i><span class="response">Users</span></a></li>
                            <li class="list-item"><a href="javascript:{}" onClick="adminLoad('posts');"><i class="fa fa-clipboard"></i><span class="response">Posts</span></a></li>
                            <li class="list-item"><a href="javascript:{}" onClick="adminLoad('flags');"><i class="fa fa-flag"></i><span class="response">Flags</span></a></li>
                            <li class="list-item"><a href="javascript:{}" onClick="adminLoad('notifications');"><i class="fa fa-comments"></i><span class="response">Notifications</span></a></li>
                        </ul>
                    </div>
                    <div id="admin-box" class="basic-box-body">
                        <div id="admin-container" class="container">
                        </div>
                    </div>
                </div>   
            </div>
       </div>
    </body>
</html>