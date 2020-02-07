<?php
session_start();

require 'db.php';

/* Allowed File Extensions */
$videos_ext = array("mp4", "webm");
$images_ext = array("png", "jpeg", "jpg", "gif");
$flash_ext = array("swf");

/* Destination Folders */
$video_folder = '../uploads/videos/';
$flash_folder = '../uploads/flash/';
$picture_folder = '../uploads/photo/';

$user = '';
if(isset($_SESSION['id'])){
    $user = $_SESSION['id'];
}else{
    $user = uniqid('anon_');
}

$upload_type = '';
$put_folder = '';
$tags = array();

if(isset($_FILES['file'])){
    $file_name = $_FILES['file']['name'];
    
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_er = $_FILES['file']['error'];
    $post_name = '';
    if(isset($_POST['tags']) && isset($_POST['name'])){
        $tags = explode(',',$_POST['tags']);
        $post_name = $_POST['name'];
    }
    $ext = explode('.',$file_name);
    $file_ext = strtolower(end($ext));
    if(in_array($file_ext, $videos_ext)){
        $put_folder = $video_folder;
        $upload_type = 'video';
    }else if(in_array($file_ext, $images_ext)){
        $put_folder = $picture_folder;
        $upload_type = 'image';
    }else if(in_array($file_ext, $flash_ext)){
        $put_folder = $flash_folder;
        $upload_type = 'flash';
    }
    
    $new_name = uniqid($upload_type.'_').'.'.$file_ext;
    $postid = uniqid();
    $timestamp = date('Y-m-d H:i:s');
    
    /* echo 'Type: '.$upload_type.', Folder: '.$put_folder.', Name: '.$new_name.', User: '.$user; */
    
    if($file_tmp != ''){
				/* Move File update tabels */
				if(move_uploaded_file($file_tmp, $put_folder.$new_name)){
						$ex = array($postid, $post_name, $new_name, $upload_type, $_POST['tags'], $user, $timestamp);
						$prep = 'INSERT INTO `posts` (`id`, `name`, `loc`, `type`, `tags`, `user`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?)';
						if(isset($_POST['thumb'])){
							$thumb_name = 'thumb_'.$postid.'.png';
							list($type, $data) = explode(';', $_POST['thumb']);
							list(, $data) = explode(',', $data);
							$data = base64_decode($data);
							if(file_put_contents('../uploads/thumbs/'.$thumb_name , $data)){
								$ex = array($postid, $post_name, $new_name, $thumb_name, $upload_type, $_POST['tags'], $user, $timestamp);
								$prep = 'INSERT INTO `posts` (`id`, `name`, `loc`, `thumb`, `type`, `tags`, `user`, `date_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
							}
						}
						$stmt = $pdo->prepare($prep);
						$stmt->execute($ex);
						$ex = array($postid);
						
						$stmt = $pdo->prepare('INSERT INTO tags (tag, used) VALUES (?, 1) ON DUPLICATE KEY UPDATE used=used+1;');
						foreach($tags as $t){
							$stmt->execute([$t]);
						}
						echo BuildJson(00, 'File Upload Complete', $postid);	
						

				}else{
						echo BuildJson(02, 'File Move Failed', '');
				}
    }else{
        echo BuildJson(01, $file_er, '');
    }
}

function BuildJson($erno, $msg, $extra){
    $json = array('error'=>$erno, 'msg'=>$msg, 'extra'=>$extra);
    return json_encode($json);
}



?>