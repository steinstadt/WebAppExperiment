<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $login_name = $_SESSION['login_name'];
  $user_id = $_SESSION['id'];
  $title = $_GET['title'];
  $category = $_GET['category'];
  $detail = $_GET['detail'];
  $target = $_GET['target'];

  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  // 投稿する
  $query = "INSERT INTO request(client, category, detail, title, target)
  VALUES($1,$2,$3,$4, $5) RETURNING id";
  $result = pg_prepare($conn, "upload", $query);
  $result = pg_execute($conn, "upload", array($user_id, $category, $detail, $title, $target));

  // 裁判リストにも仮追加
  $row = pg_fetch_assoc($result,0);
  $request_id = $row['id'];
  $query = "INSERT  INTO judge(request) VALUES($1)";
  $result = pg_prepare($conn, "judge_insert", $query);
  $result = pg_execute($conn, "judge_insert", array($request_id));

  $data = '1';
  echo json_encode(compact('data'));
?>
