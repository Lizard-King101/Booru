<?php
include "../../db.php";
$retArr = array();
$retArr['post'] = $_POST;
if(isset($_POST['dowhat'])){
	if(isset($_POST['id']) && $_POST['id'] != ""){
		$id = $_POST['id'];
	}else{
		$id = uniqid();
	}
	if($_POST['dowhat'] == "update_opt"){
		$opt = $_POST['option'];
		$data = $_POST['data'];
		if($opt == 'active'){
			$data = $_POST['data'] == "true" ? 1 : 0;
		}
		$stmt = $pdo->query("UPDATE `notifications` SET $opt = '$data' WHERE `id` = '$id' ");
	}
	
	if($_POST['dowhat'] == "new"){
		$ex = [$id, $_POST['page'], htmlentities($_POST['html']), $_POST['head'], 1];
		
		$stmt = $pdo->prepare('INSERT INTO `notifications` (id, page, content, head, active) VALUES (?,?,?,?,?)');
		$stmt->execute($ex);
	}
	
	if($_POST['dowhat'] == "update_not"){
		$html = htmlentities($_POST['html'], ENT_QUOTES);
		$stmt = $pdo->query("UPDATE `notifications` SET content = '$html' WHERE `id` = '$id' ");
	}
	
	if($_POST['dowhat'] == "delete"){
		$stmt = $retArr['deleted'] = $pdo->query("DELETE FROM `notifications` WHERE `id` = '$id' ");
		
	}
	
}


echo json_encode($retArr);
?>