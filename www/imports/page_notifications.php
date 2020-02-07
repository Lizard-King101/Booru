<?php 
include "ajax/db.php";
$page = basename($_SERVER['PHP_SELF'],'.php') == "index" || "" ? "home" : basename($_SERVER['PHP_SELF'],'.php');

$stmt = $pdo->query("SELECT * FROM `notifications` WHERE page = '$page' AND active = 1 ");
$notif = $stmt->fetchAll();
if($notif){
?>
<div class="row">
<div class="col-sm-12">
<?php
foreach($notif as $n){ ?>
<div class="basic-box info">
   <div class="basic-box-head">
	   <h3><?php echo $n['head']; ?></h3>
   </div>
   <div class="basic-box-body">
	<?php echo html_entity_decode($n['content']); ?>
   </div>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
