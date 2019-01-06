<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $judge_id = $_POST['judge_id'];

  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  // 投稿する
  $query = "UPDATE judge SET evaluation=evaluation+1 WHERE id=$1";
  $result = pg_prepare($conn, "good_upload", $query);
  $result = pg_execute($conn, "good_upload", array($judge_id));

  $data = 'success!';
  echo json_encode(compact('data'));
?>
