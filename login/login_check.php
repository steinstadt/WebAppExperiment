<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  // $data = "{$_POST['login_name']}歳、{$_POST['pwd']}です";
   $login_name = $_POST['login_name'];
   $pwd = $_POST['pwd'];

  // データベースアクセス
  $conn = pg_connect("host=localhost dbname=j161691k user=j161691k");
  $query = "SELECT * FROM users WHERE login_name=$1";
  $result = pg_prepare($conn, "my_query", $query);
  $result = pg_execute($conn,"my_query", array($login_name));
  //
  if (pg_num_rows($result)==1) {
    $row = pg_fetch_assoc($result, 0);
    if (password_verify($pwd, $row['pass_word'])) {
      // ログイン成功
      $data = '1';
      $_SESSION['login_name'] = $login_name;
      $_SESSION['id'] = $row['id'];
      echo json_encode(compact('data'));
    }else {
      // ログイン失敗
      $data = '2';
      echo json_encode(compact('data'));
     }
  }

  // 失敗の時は「400 Bad Request」でエラーを返す
  // http_response_code(400);
  // echo json_encode(compact('error'));
?>
