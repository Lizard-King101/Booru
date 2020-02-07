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

<script>
    $(document).ready(function(){
        Search(<?php 
				if(isset($_SESSION['back_tags'])){
					echo "'".$_SESSION['back_tags']."'";
					if(isset($_SESSION['back_page'])){
					   echo ", ".$_SESSION['back_page'];
					}
			   }
			   ?>);
    });
</script>
   <div id="body-wrap">
        <div id="nav-box">
            <?php include 'side-nav.php';?>
        </div>
        <div id="body-box">
           <?php include 'navbar.php';?>
            <div class="container body">
            	
                <div class="row nav-on-response">
                    <div class="basic-box search" style="margin-bottom: 0;">
						<div class="basic-box-body">
							<form id="mobile-search-form" action="">
								<input type="text" placeholder="Search" value="<?php if(isset($_SESSION['back_tags'])){echo $_SESSION['back_tags'];}?>">
							</form>
						</div>
					</div>
                </div>
                
                <?php include "imports/page_notifications.php"; ?>
                
                <div class="row">
                    <div id="main-col" class="col-sm-12">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3>Search</h3> - <p class="search-info"></p>
                            </div>
                            <div class="row basic-box-body posts-box search-box">
                            </div>
                            <div id="page-tabs" class="basic-box-foot">
                            	
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
   </div>
</body>
</html>