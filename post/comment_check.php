<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $user_id = $_SESSION['id'];
  $judge_id = $_POST['judge_id'];
  $message = $_POST['message'];

  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  // 投稿する
  $query = "INSERT INTO chatgroup (judge, commentator, message) VALUES($1, $2, $3)";
  $result = pg_prepare($conn, "comment_insert", $query);
  $result = pg_execute($conn, "comment_insert", array($judge_id, $user_id, $message));

  $query = "SELECT u.login_name, c.message FROM users u, chatgroup c
            WHERE u.id=c.commentator AND c.judge=$1 ORDER BY chat_time DESC";
  $result = pg_prepare($conn, "chat_select", $query);
  $result = pg_execute($conn, "chat_select", array($judge_id));
  $num = pg_num_rows($result);
  $data = array();
  for($i=0;$i<$num;$i++){
    $row = pg_fetch_assoc($result, $i);
    $key_name = "key{$i}";
    $data[$key_name] = array('login_name'=>$row['login_name'], 'message'=>$row['message']);
  }

  echo json_encode(compact('data'));
?>
