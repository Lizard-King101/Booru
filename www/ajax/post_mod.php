<?php
include 'db.php';
$setter = '';
$col = '';
if(isset($_POST['dowhat']) && isset($_POST['set']) && isset($_POST['id'])){
    $setter = array($_POST['set'], $_POST['id']);
		$col = $_POST['dowhat'];
		$stmt = $pdo->prepare("UPDATE `posts` SET $col = '?' WHERE id = '?'");
		$stmt->execute($setter);
		echo $stmt->fetch();
}

?>