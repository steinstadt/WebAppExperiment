<?php
	session_name("j161691k");
	session_start();
	
	// Content-TypeをJSONに指定する
	header('Content-Type: application/json');
	
	$judge_id = $_POST['judge_id'];
	$judge_result = $_POST['judge_result'];
	$judge_reason = $_POST['judge_reason'];
	
	// SQLクエリ
	$conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
	$query = "UPDATE judge SET result=$1, reason=$2 WHERE request=$3";
	$result = pg_prepare($conn, "judge_update", $query);
	$result = pg_execute($conn, "judge_update", array($judge_result, $judge_reason, $judge_id));
	
	$data = 'success';
	echo json_encode(compact('data'));
?>