<?php
  session_name("j161691k");
  session_start();
  session_destroy();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $data = '1';
  echo json_encode(compact('data'));
?>
