<?php
  session_name("j161691k");
  session_start();

  // Content-TypeをJSONに指定する
  header('Content-Type: application/json');

  $judge_id = $_POST['judge_id'];

  $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
  // 詳細表示要素を抽出する
  $query = "SELECT r.title, m.login_name AS master, u.login_name AS plaintiff, r.target, r.detail,
            j.result, j.reason
            FROM request r, users m, users u, judge j
            WHERE u.id=r.client AND r.id=j.request AND j.master=m.id AND j.id=$1";
  $result = pg_prepare($conn, "detail_select", $query);
  $result = pg_execute($conn, "detail_select", array($judge_id));

  // データの成形
  $row = pg_fetch_assoc($result,0);
  if ($row['result']==1) {
    $result_data = '有罪';
  }else {
    $result_data = '無罪';
  }
  $detail_array = array('title'=>$row['title'], 'master'=>$row['master'],
							'plaintiff'=>$row['plaintiff'], 'target'=>$row['target'],
              'detail'=>$row['detail'], 'reason'=>$row['reason'], 'result'=>$result_data);

  $data = '1';
  echo json_encode(compact('detail_array'));
?>
