<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $judge_id = $_POST['judge_id'];

  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  // 投稿する
  $query = "SELECT u.login_name, c.message FROM users u, chatgroup c
            WHERE u.id=c.commentator AND c.judge=$1";
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
