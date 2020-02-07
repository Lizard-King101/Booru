<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'imports/jquery.php';?>
    <?php include 'imports/bootstrap.php';?>
    <?php include 'imports/fontawesome.php';?>
    <?php include 'imports/global.php';?>
    <link rel="stylesheet" href="css/settings.css">
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
                   <div class="col-sm-12">
                       <div class="basic-box">
                           <div class="basic-box-head">
                               <h3>Settings</h3>
                           </div>
                           <div class="basic-box-body">
                               <ul class="list">
                                   <?php echo Slider('Some Setting', 'one');?>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</body>
</html>
<?php function Slider($setting, $funct){?>
    <li class="list-item">
        <span class="item-label">
            <?php echo $setting; ?>
        </span>
        <label class="switch item-right">
           <input type="checkbox">
           <span class="slider round"></span>
        </label>
    </li>
<?php } ?>