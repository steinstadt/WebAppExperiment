<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $pwd = $_POST['pwd'];
  $newpwd = $_POST['newpwd'];
  $user_id = $_SESSION['id'];
  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  $query1 = "SELECT * FROM users WHERE id = $1";
  $result1 = pg_prepare($conn, "change_pwd", $query1);
  $result1 = pg_execute($conn, "change_pwd", array($user_id));
  $row = pg_fetch_assoc($result1, 0);
  if (password_verify($pwd, $row['pass_word'])) {
    // パスワードが正しい
    $newpwd_hash = password_hash($newpwd, PASSWORD_DEFAULT);
    $query2 = "UPDATE users SET pass_word = $1 WHERE id = $2";
    $result2 = pg_prepare($conn, "update", $query2);
    $result2 = pg_execute($conn, "update", array($newpwd_hash, $user_id));

    $data = '1';
    echo json_encode(compact('data'));
  }else {
    // パスワードが間違っている
    $data = '2';
    echo json_encode(compact('data'));
  }
?>
