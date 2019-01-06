<?php
	session_name("j161691k");
	session_start();
	
	// Content-TypeをJSONに指定する
	header('Content-Type: application/json');
	
	$user_id = $_SESSION['id'];
	$req_id = $_POST['req_id'];
	
	$conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
	// judgeテーブルの更新
	$query = "UPDATE judge SET master=$1 WHERE request=$2";
	$result = pg_prepare($conn, "judge-update", $query);
	$result = pg_execute($conn, "judge-update", array($user_id, $req_id));
	
	
	
	$data = 'success!';
	echo json_encode(compact('data'));
	
?>