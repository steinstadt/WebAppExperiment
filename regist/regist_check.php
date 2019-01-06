<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $login_name = $_POST['login_name'];
  $pwd = $_POST['pwd'];

  $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

  $conn = pg_connect("host=localhost dbname=j161691k user=j161691k");
  $query = "INSERT INTO users (login_name, pass_word) VALUES($1, $2)";
  $result = pg_prepare($conn, "q1", $query);
  $result = pg_execute($conn, "q1", array($login_name, $hashpwd));

  $data = "success";
  echo json_encode(compact('data'));
 ?>
