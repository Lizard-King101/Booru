<?php
session_start();
include 'db.php';

/* Start Pagination */
$page = 0;
$per_page = 16;
if(isset($_POST['per_page']) && $_POST['per_page'] != ''){
  $per_page = $_POST['per_page'];
}

$page_min = 0;
$page_max = $per_page;

if(isset($_POST['page']) && $_POST['page'] != ''){
  $_SESSION['back_page'] = $_POST['page'];
  $page = $_POST['page'];
  $page_min = $page * $per_page;
  $page_max = (($page + 1) * $per_page)-1;
}
$page_info = array('page'=>$page, 'min'=>$page_min, 'max'=>$page_max,'perpage'=>$per_page, 'total'=>0);
$paginate = "LIMIT $page_min , $per_page ";
/* End Paginate */

if(isset($_POST['type']) && $_POST['type'] != ''){
	if($_POST['type'] == 'latest'){
			$stmt = $pdo->query('SELECT * FROM posts ORDER BY date_time DESC LIMIT 24');
			$posts = $stmt->fetchAll();
	}else if($_POST['type'] == 'featured'){
			$stmt = $pdo->query('SELECT * FROM posts WHERE featured=1 ORDER BY date_time DESC LIMIT 10');
			$posts = $stmt->fetchAll();
	}
	
	echo json_encode(['posts'=>$posts, 'page_info'=>$page_info]);
}else{
	/* Tag Search Else All */
	
	if(isset($_POST['tags']) && $_POST['tags'] != ''){
		$_SESSION['back_tags'] = $_POST['tags'];
		$tags = explode(',', $_POST['tags']);
		$like = [];
		$notlike = [];
		$values = [];

		foreach($tags as $t){
			if($t[0] == '-'){
				array_push($notlike, substr($t, 1));
			}else{
				array_push($like, $t);
			}
		}

		$column = 'tags';
		$query = "";
		$query_posts = "SELECT * FROM `posts` WHERE ";
		$query_count = "SELECT COUNT(*) AS 'total' FROM `posts` WHERE ";

		if(count($notlike) > 0){
			$query = $query."( ";
			foreach($notlike as $i=>$t){
				if($i == 0){
					$query = $query.$column." NOT LIKE ? ";
				}else{
					$query = $query."AND ".$column." NOT LIKE ? ";
				}
				array_push($values, '%'.$t.'%');
			}
			if(count($like) >= 1){
				$query = $query.") AND ";
			}
		}

		foreach($like as $i=>$t){
			if($i == 0){
				if(count($notlike) == 0){
					$query = $query.$column." LIKE ? ";
				}else{
					$query = $query."( ".$column." LIKE ? "; 
				}
			}else{
				$query = $query."OR ".$column." LIKE ? ";
			}

			array_push($values, '%'.$t.'%');
		}
		if(count($notlike) > 0){
			$query = $query.")";
		}
		$temp_query = $query_posts.$query.$paginate;

		$stmt = $pdo->prepare($temp_query);
		$stmt->execute($values);
		$posts = $stmt->fetchAll();

		$temp_query = $query_count.$query;

		$stmt = $pdo->prepare($temp_query);
		$stmt->execute($values);
		$page_info['total'] = $stmt->fetch()['total'];

		echo json_encode(['posts'=>$posts, 'query'=>$query_posts.$query.$paginate, 'values'=>$values, 'tags'=>$tags, 'page_info'=>$page_info ]);

	}else{
		$_SESSION['back_tags'] = "";
		$query_posts = "SELECT * FROM `posts` ORDER BY date_time DESC ";
		$query_count = "SELECT COUNT(*) AS 'total' FROM `posts` ";

		$temp_query = $query_posts.$paginate;

		$stmt = $pdo->prepare($temp_query);
		$stmt->execute();
		$posts = $stmt->fetchAll();

		$temp_query = $query_count;

		$stmt = $pdo->prepare($temp_query);
		$stmt->execute();
		$page_info['total'] = $stmt->fetch()['total'];

		echo json_encode(['posts'=>$posts, 'page_info'=>$page_info]);
	}
	
}


?>