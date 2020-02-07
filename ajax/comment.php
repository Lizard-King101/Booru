<?php 
session_start();
include 'db.php';
if(isset($_POST['message']) && isset($_POST['post'])){
    $user = $_SESSION['id'];
    $comment_id = uniqid();
    $post_id = $_POST['post'];
    $message = $_POST['message'];
    $date_time = date('Y-m-d H:i:s');
    $ex = [$comment_id, $post_id, $user, $message, $date_time];
    $stmt = $pdo->prepare('INSERT INTO comments (comment_id, post_id, user, message, date_time) VALUES (?,?,?,?,?)');
    if($stmt->execute($ex)){
        $stmt = $pdo->prepare("SELECT comments.message, comments.date_time, members.username, members.profile FROM comments JOIN members ON members.id = comments.user WHERE post_id = ? ORDER BY comments.date_time DESC");
        $stmt->execute([ $post_id ]);
        $comments = $stmt->fetchAll();
        foreach($comments as $c){
        ?>
            <li class="list-item comment-block">
                <span class="img-circle user" style="background-image: url('../uploads/users/profile/<?php echo $c['profile'];?>');"></span>
                <span class="username"><?php echo $c['username']?></span>
                <span class="date"><?php echo date('M j, Y g:i A', strtotime($c['date_time'])) ?></span>
                <span class="comment"><?php echo $c['message'] ?></span>
            </li> 
        <?php
        }
    }
} ?>