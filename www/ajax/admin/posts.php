<?php
	include "../db.php";
	$stmt = $pdo->query("CREATE TABLE `booru`.`ratings` ( `post` VARCHAR(32) NOT NULL , `user` VARCHAR(32) NOT NULL , `rate` TINYINT(1) NOT NULL ) ENGINE = InnoDB;");
?>