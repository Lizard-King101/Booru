<?php
include 'db.php';
$post_id = '';
$clean_id = '';
if(preg_match("/^[a-zA-Z0-9]+$/", $_GET['id']) == 1) {
    $clean_id = $_GET['id'];
    $post_id = array($_GET['id']);
}else{
    header('Location: /warn.php?case=1');
}
$check = "";
if(isset($_SESSION['id'])){
	$check = "LEFT JOIN ratings r ON (r.post = p.id AND r.user = '".$_SESSION['id']."') ";
}
$stmt = $pdo->prepare("SELECT * FROM posts p ".$check."WHERE p.id = ?");
$stmt->execute($post_id);
$post = $stmt->fetchAll();

print_r($post);

$prep = "SELECT c.message, c.date_time, m.username, m.profile FROM comments c JOIN members m ON (m.id = c.user) WHERE post_id = ? ORDER BY c.date_time DESC";
$stmt = $pdo->prepare($prep);
$stmt->execute([ $post[0]['id'] ]);
$comments = $stmt->fetchAll();

foreach($post as $p){
    $view = $p['views'];
    $view = $view + 1;
    $upd = $pdo->prepare("UPDATE `posts` SET views=? WHERE id=?");
    $upd->execute(array($view, $clean_id));
    
    $upd = $pdo->query("SELECT r.rate, count(*) as amount FROM `ratings` as r GROUP BY r.rate ORDER BY r.rate");
    $vote = $upd->fetchAll();

    $id = array($p['user']);
    $stmt = $pdo->prepare('SELECT * FROM members WHERE id = ?');
    $stmt->execute($id);
    $userr = $stmt->fetchAll();
    $profile = $userr[0]['profile'];
    $user = $userr[0]['username'];
    
    $rate = 'none';
		if(isset($p['rate'])){
			if($p['rate'] == '1'){
				$rate = 'up';
			}else if($p['rate'] == '-1'){
				$rate = 'down';
			}
		}
    
    if($p['type'] == 'image'){
        DisplayPicture($p['name'], $p['loc'], $p['id'], $user, $profile, $view, $vote[1]['amount'], $vote[0]['amount'], $rate);
    }else if($p['type'] == 'video'){
        DisplayVideo($p['name'], $p['loc'], $p['id'], $user, $profile, $view, $vote[1]['amount'], $vote[0]['amount'], $rate);
    }else if($p['type'] == 'flash'){
        DisplayFlash($p['name'], $p['loc'], $p['id'], $user, $profile, $view, $vote[1]['amount'], $vote[0]['amount'], $rate);
    }
}


function DisplayVideo($name, $file, $id, $user, $profile, $views, $up, $down, $rate){
?>
    <script src="../js/video-manager.js"></script>
    <div class="background dark">
        <div class="container expandable">
            <div class="row">
                <div class="col-xs-12 add-pad">
                    <div id="video-container">
                        <div id="video-info">
                          <h3 id="video-title"></h3>
                        </div>
                        <video id="video-player" <?php if(isset($_SESSION) && $_SESSION['autoplay'] == 'true'){?>autoplay<?php }?> >
                            <source src="../uploads/videos/<?php echo $file;?>">
                        </video>
                        <div id="video-controls">
                          <span id="playback-bar">
                            <span id="playback-bar-visable">
                              <span id="prog-bar"><a id="prog-circle"></a></span>
                              <span id="scrub-bar"><div id="scrub-box"><span id="scrub-time"></span></div></span>
                              <span id="buffer-bar"></span>
                            </span>
                          </span>
                          <i id="play" onClick="PlayPause()" class="fa fa-play" aria-hidden="true"></i>
                          <div id="volume"><i onClick="MuteToggle(this)" id="volume-icon" class="fa fa-volume-up"></i><input id="volume-slider" type="range" min="0" max="1" step=".01"></div>
                          <i id="settings" onClick="ShowSettings()" class="fa fa-cog"></i>
                          <div id="video-time"><span id="current-time"></span>&nbsp;/&nbsp;<span id="vid-duration"></span></div>
                          <i id="fullscreen" class="fa fa-square-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    DisplayInfo($name, $id, $user, $profile, $views, $up, $down, $rate);
}

function DisplayFlash($name, $file, $id, $user, $profile, $views, $up, $down, $rate){
    $info = getimagesize('uploads/flash/'.$file);
    $width = $info[0];
    $height = $info[1];
    $percent = (100*$height)/$width;
?>
    <div class="background dark">
        <div class="container expandable">
            <div class="row">
                <div class="col-xs-12 add-pad">
                    <div class="flash-container" style="padding-bottom: <?php echo  $percent;?>%">
                        <object data="../uploads/flash/<?php echo $file?>" type="application/x-shockwave-flash" menu="false" width="100%" height="100%">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    DisplayInfo($name, $id, $user, $profile, $views, $up, $down, $rate);
}

function DisplayPicture($name, $file, $id, $user, $profile, $views, $up, $down, $rate){
    $info = getimagesize('uploads/photo/'.$file);
    $width = $info[0];
    $height = $info[1];
    $percent = (100*$height)/$width;
    if($width >= 1900){ ?>
        <script>
            var canMax = true;
        </script>
    <?php }else{ ?>
        <script>
            var canMax = false;
        </script>
    <?php } ?>
    
    <style>
        img.full{
            width: <?php echo $width;?>px;
            height: <?php echo $height;?>px;
            transition: .4s;
        }
    </style>
    <script src="../js/photoManager.js"></script>
    <div class="background dark">
        <div class="container expandable">
            <div id="photo-box" class="loading" style="padding-bottom: <?php echo $percent;?>%">
                <div class="absolute-img">
                    <img src="../uploads/photo/<?php echo $file?>" alt="<?php echo $name;?>">
                </div>
            </div>
        </div>
    </div>
<?php
    DisplayInfo($name, $id, $user, $profile, $views, $up, $down, $rate);
}

function DisplayInfo($name, $id, $user, $profile, $views, $up, $down, $rate){ ?>
   
    <div class="background post-info">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="list il">
                        <li class="list-item post-name"><?php echo $name;?></li>
                    </ul>
                    <ul class="list il right">
                        <?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 'true' ){?>
                        <li class="list-item"><a data-id="<?php echo $id ?>" id="feature"><i class="fa fa-thumbtack"></i></a></li>
                        <?php } ?>
                        <li class="list-item"><span class="views"><?php echo $views;?></span></li>
                        <li class="list-item">
                        	<a data-rate="" data-id="" id="vote-down">
                        		<i class="fa fa-thumbs-up"></i>
                        	</a>
                        	<span class="vote up"><?php echo $up;?></span>
                        </li>
                        <li class="list-item">
                        	<a data-rate="" data-id="" id="vote-up">
                        		<i class="fa fa-thumbs-down"></i>
                        	</a>
                        	<span class="vote down"><?php echo $down;?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list il">
                        <li class="list-item">
                            <span class="img-circle" style="background-image: url('../uploads/users/profile/<?php echo $profile;?>');"></span>
                        </li>
                        <li class="list-item">
                            <?php echo $user;?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
}

?>