<?php require "login/loginheader.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'imports/jquery.php';?>
    <?php include 'imports/bootstrap.php';?>
    <?php include 'imports/fontawesome.php';?>
    <?php include 'imports/global.php';?>
    <link rel="stylesheet" href="css/view.css">
</head>
<body>
   <div id="body-wrap">
        <div id="nav-box">
            <?php include 'side-nav.php';?>
        </div>
        <div id="body-box">
           <?php include 'navbar.php';?>
            <?php 
                if(isset($_GET['id'])){
                    include 'ajax/post_load.php';
                }else{
                    header('Location: index.php');
                }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="basic-box">
                            <div class="basic-box-head">
                               <h3>Comments</h3>
                            </div>
                            <div class="basic-box-body">
                                <?php if(isset($_SESSION['id'])){ ?>
                                    <div class="comment-form">
                                        <form id="comment" data-post="<?php echo $post[0]['id'];?>">
                                            <input type="text" placeholder="Comment">
                                            <input type="submit" value="Send">
                                        </form>
                                    </div>
                                <?php }else{ ?>
                                    <div class="comment-form block">
                                        Please Sign in to Comment
                                    </div>
                                <?php }?>
                                <ul class="list" id="comment-list">
                                    <?php foreach($comments as $c){?>
                                    <li class="list-item comment-block">
                                        <span class="img-circle user" style="background-image: url('../uploads/users/profile/<?php echo $c['profile'];?>');"></span>
                                        <span class="username"><?php echo $c['username']?></span>
                                        <span class="date"><?php echo date('M j, Y g:i A', strtotime($c['date_time'])) ?></span>
                                        <span class="comment"><?php echo $c['message'] ?></span>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="basic-box">
                            <div class="basic-box-head">
                                <h3>Tags</h3>
                            </div>
                            <div class="basic-box-body tags">
                                <?php 
                                    $tags = explode(',', $post[0]['tags']);
                                    foreach($tags as $t){ 
                                    $tag = str_replace('_', ' ', $t);?>
                                    <span class="tag" onclick="tagSearch('<?php echo $tag; ?>')"><?php echo $tag; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>   
        </div>
   </div>
</body>
</html>