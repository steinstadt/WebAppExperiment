<?php
	session_name("j161691k");
	session_start();

	// Content-TypeをJSONに指定する
	header('Content-Type: application/json');

	$keyword = "%{$_POST['keyword']}%";
	$category = $_POST['category'];
     
	 // SQLクエリ
	 $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
	if($category == 0){
		// カテゴリがすべての場合
		$query = "SELECT u.login_name, r.id,  r.title, c.category_name 
					FROM users u, request r, category c, judge j 
					WHERE u.id=r.client and r.category=c.id and j.request=r.id 
					and j.master IS NULL and r.title like $1";
		$result = pg_prepare($conn, "search", $query);
		$result = pg_execute($conn, "search", array($keyword));
		$num = pg_num_rows($result);
		$data = array();
		for($i=0;$i<$num;$i++){
			$row = pg_fetch_assoc($result, $i);
			$keyname = "key{$i}";
			$data[$keyname] = array('req_id'=>$row['id'],'login_name'=>$row['login_name'], 'title'=>$row['title'], 'category_name'=>$row['category_name']);
		}
		
	}else{
		$query = "SELECT u.login_name, r.id,  r.title, c.category_name 
					FROM users u, request r, category c, judge j 
					WHERE u.id=r.client and r.category=c.id and j.request=r.id 
					and j.master IS NULL and r.title like $1 and c.id=$2";
		$result = pg_prepare($conn, "search", $query);
		$result = pg_execute($conn, "search", array($keyword, $category));
		$num = pg_num_rows($result);
		$data = array();
		for($i=0;$i<$num;$i++){
			$row = pg_fetch_assoc($result, $i);
			$keyname = "key{$i}";
			$data[$keyname] = array('req_id'=>$row['id'],'login_name'=>$row['login_name'], 'title'=>$row['title'], 'category_name'=>$row['category_name']);
		}
	}
	
	echo json_encode(compact('data'));
	
?>