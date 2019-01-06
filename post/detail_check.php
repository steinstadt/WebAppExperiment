<?php
	session_name("j161691k");
	session_start();

	// Content-TypeをJSONに指定する
	header('Content-Type: application/json');

	$req_id = $_POST['req_id'];

	$conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
	// 詳細データを抽出
	$query = "SELECT u.login_name, c.category_name, r.detail, r.client_time, r.target
	FROM request r, users u, category c WHERE u.id=r.client AND r.category=c.id AND r.id=$1";
	$result = pg_prepare($conn, "detail_upload", $query);
	$result = pg_execute($conn, "detail_upload", array($req_id));
	$row = pg_fetch_assoc($result, 0);
	$detail_array = array('login_name'=>$row['login_name'], 'category_name'=>$row['category_name'],
							'detail'=>$row['detail'], 'client_time'=>$row['client_time'], 'target'=>$row['target']);

	echo json_encode(compact('detail_array'));
?>
