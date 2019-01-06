<?php
  session_name("j161691k");
  session_start();
?>
<!-- スタート画面 -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/start.css">
    <title>スタート画面(情報工学実験)</title>
  </head>
  <body>
    <!-- 左画面　メニュー -->
    <div id="menu">
      <!-- メニューバー -->
      <div class="list-group">
        <?php
          if(isset($_SESSION['login_name'])){
            print "<a href=\"#\" id=\"user\" class=\"list-group-item list-group-item-action\">引き受け依頼一覧</a>";
            print "<a href=\"#\" id=\"postreq\" class=\"list-group-item list-group-item-action\">依頼投稿</a>";
            print "<a href=\"#\" id=\"listreq\" class=\"list-group-item list-group-item-action\">依頼一覧</a>";
  		      print "<a href=\"#\" id=\"chat\" class=\"list-group-item list-group-item-action\">傍聴席</a>";
            print "<a href=\"#\" id=\"judgelist\" class=\"list-group-item list-group-item-action\">判例一覧</a>";
            print "<a href=\"#\" id=\"masterrank\" class=\"list-group-item list-group-item-action\">裁判官ランキング</a>";
            print "<a href=\"#\" id=\"password\" class=\"list-group-item list-group-item-action\">パスワード変更</a>";
            print "<a href=\"#\" id=\"logout\" class=\"list-group-item list-group-item-action\">ログアウト</a>";
          }
        ?>
      </div>
      <br>
      <br>
      <!-- ユーザー情報 -->
      <div id="user_data">
          <p class="lead" align="center">あなたのスコア</p>
          <h1 class="display-4" align="center">
            <!-- PHPクエリ -->
            <?php
              if(isset($_SESSION['login_name'])){
                // SQLクエリ
                $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
                $query = "SELECT FLOOR(AVG(evaluation)) AS eval_avg FROM judge
                          WHERE judge.master=$1";
                $result = pg_prepare($conn, "evaluation_average", $query);
                $result = pg_execute($conn, "evaluation_average", array($_SESSION['id']));
                $row = pg_fetch_assoc($result, 0);
                echo htmlspecialchars($row['eval_avg'], ENT_QUOTES, 'UTF-8');
              }
            ?>
            点
          </h1>
          <hr class="my-4">
          <p>他のユーザーがあなたの判決を評価します。</p>
      </div>
    </div>

    <div id="contents" style="overflow-y: scroll;">
		<img src="./images/sample.jpg" alt="サンプル画像" style="width:440px; height:60px">
      <!-- 依頼引き受け一覧 -->
      <div id="userinfo">
        <div class="ui-container">
          <h1 style="margin-left:8px;">引き受け依頼一覧</h1>
		  <p>[依頼一覧]から選んだ案件が表示されます</p>
      		<?php
            if(isset($_SESSION['login_name'])){
              $user_id = $_SESSION['id'];
        			// 引き受け中の案件一覧を表示する
        			$conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
        			$query = "SELECT u.login_name, r.client_time, c.category_name, r.detail, j.id
        							FROM judge j, users u, request r, category c
        							WHERE u.id=j.master and j.request=r.id and r.category=c.id and j.master=$1 and j.result IS NULL";
        			$result = pg_prepare($conn, "judge_select", $query);
        			$result = pg_execute($conn, "judge_select", array($user_id));
        			$num = pg_num_rows($result);
        			for($i=0;$i<$num;$i++){
        				$row=pg_fetch_assoc($result, $i);
        				print "<div style=\"border-style: dotted; margin-left:8px; margin-right:8px;\">";
        				print "<h1 style=\"float:left;\">";
                echo  htmlspecialchars($row['login_name'], ENT_QUOTES, 'UTF-8');
                print "さんの依頼</h1>";
        				print "<small style=\"float:right; margin-right: 100px;\">投稿日時：{$row['client_time']}</small>";
        				print "<div class=\"clear-element\"></div>";
        				print "<br><br>";
        				print "<h4>カテゴリ : {$row['category_name']}</h4>";
        				print "<br>";
        				print "<h4>依頼詳細</h4>";
        				print "<p style=\"margin-right:3px; margin-left:3px\">";
                echo htmlspecialchars($row['detail'], ENT_QUOTES, 'UTF-8');
                print "</p>";
        			  print "<br>";
        				// 回答部分
        				print "<div id=judge{$row['id']} style=\"display: none; margin-bottom:50px; margin-top:50px;\">";
        				print "<form style=\"margin-left:24px; margin-right:24px; background-color: beige;\">";
        				print "＜回答欄＞";
        				print "<fieldset class=\"form-group\">";
        				print "<div class=\"row\">";
        				print "<legend class=\"col-form-label col-sm-2 pt-0\">判決</legend>";
        				print "<div class=\"col-sm-10\">";
        				print "<div class=\"form-check\">";
        				print "<input pattern=\"^[0-9A-Za-z]+$\" class=\"form-check-input\" type=\"radio\" name=\"judge_result{$row['id']}\" value=\"1\" checked>";
        				print "<label class=\"form-check-label\">";
        				print "有罪";
        				print "</label>";
        				print "</div>";
        				print "<div class=\"form-check\">";
        				print "<input pattern=\"^[0-9A-Za-z]+$\"  class=\"form-check-input\" type=\"radio\" name=\"judge_result{$row['id']}\" value=\"2\">";
        				print "<label class=\"form-check-label\">";
        				print "無罪";
        				print "</label>";
        				print "</div></div></div>";
        				print "<div class=\"form-group\">";
        				print "<label for=\"exampleFormControlTextarea1\">判決理由</label>";
        				print "<textarea pattern=\"^[0-9A-Za-z]+$\" class=\"form-control\" id=\"judge_reason{$row['id']}\" rows=\"3\"></textarea>";
        				print "</div></fieldset></form>";
        				print "</div>";
        				print "<button id=\"judge-button{$row['id']}\" onclick=\"clickToJudge({$row['id']})\" type=\"button\" class=\"btn btn-success\" style=\"margin-left:5px; margin-bottom:5px;\">詳細</button>";
        				print "</div>";
        				print "<br>";
              }
            }
      		?>
        </div>
      </div>

      <!-- 依頼投稿 -->
      <div id="requestpost">
        <div class="ui-container">
          <h1>依頼投稿</h1>
		  <p>さあ、悩み事を誰かに相談しよう！</p>
          <form>
            <div class="form-group">
              <label class="col-sm-4 col-form-label">依頼タイトル</label>
              <div class="col-sm-10">
                <input pattern="^[0-9A-Za-z]+$" type="text" class="form-control" id="requesttitle">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-form-label">カテゴリ</label>
              <div class="col-sm-10">
                <select class="form-control" id="requestcategory">
                  <option value="1">恋愛</option>
                  <option value="2">商売</option>
                  <option value="3">教育</option>
                </select>
              </div>
            </div>
			<div class="form-group">
              <label class="col-sm-4 col-form-label">被告人</label>
              <div class="col-sm-10">
                <input pattern="^[0-9A-Za-z]+$" type="text" class="form-control" id="requesttarget">
              </div>
            </div>
            <div class="form-group">
              <label>依頼詳細</label>
              <textarea pattern="^[0-9A-Za-z]+$" class="form-control" id="requestdetail" rows="5"></textarea>
            </div>
            <div>
              <div class="col-sm-10">
                <button href="#" id="post-button" class="btn btn-primary">依頼投稿</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- 依頼一覧 -->
      <div id="requestlist">
        <div class="ui-container">
		        <h1>依頼一覧</h1>
				<p>困っている人を助けてあげよう！</p>
				<div class="form-group">
					<table>
						<tr>
							<td>検索ワード</td>
							<td><input type="text" id="requestlist_keyword"></td>
						</tr>
						<tr>
							<td>カテゴリ</td>
							<td>
								<select class="form-control" id="requestlist_category">
									<option value="0">すべて</option>
									<option value="1">恋愛</option>
									<option value="2">商売</option>
									<option value="3">教育</option>
								</select>
							</td>
						</tr>
					</table>
					<button id="requestlist_button" type="button" class="btn btn-success">検索</button>
				</div>
            <?php
              if(isset($_SESSION['login_name'])){
                // SQLクエリ
                $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
                $query = "SELECT u.login_name, r.id,  r.title, c.category_name FROM users u, request r,
                category c, judge j WHERE u.id=r.client and r.category=c.id and j.request=r.id and j.master IS NULL";
                $result = pg_prepare($conn, "list", $query);
                $result = pg_execute($conn, "list", array());
                $num = pg_num_rows($result);
                // テーブルヘッダ
				print "<div id=\"request_list_change\">";
                print "<table class=\"table table-striped\"><thead>";
                print "<tr>";
                print "<th scope=\"col\">投稿者</th>";
                print "<th scope=\"col\">タイトル</th>";
                print "<th scope=\"col\">カテゴリ</th>";
                print "</tr>";
                print "</thead>";
                print "<tbody>";
                for($i=0;$i<$num;$i++){
                  $row=pg_fetch_assoc($result, $i);
                  print "<tr>";
                  print "<td>";
                  echo  htmlspecialchars( $row['login_name'], ENT_QUOTES, 'UTF-8' );
                  print "</td>";
                  print "<td><a href=\"#\" onclick=\"clickDetail({$row['id']}); return false;\">";
                  echo  htmlspecialchars( $row['title'], ENT_QUOTES, 'UTF-8' );
                  print "</a></td>";
                  print "<td>";
                  echo  htmlspecialchars( $row['category_name'], ENT_QUOTES, 'UTF-8' );
                  print "</td>";
                  print "</tr>";
                }
                print "</tbody>";
                print "</table>";
				print "</div>";
              }
            ?>
        </div>
      </div>

	  <!-- 依頼詳細 -->
	  <div id="detailbox">
		<div class="ui-container" style="border-style: dotted;">
			<h1 style="float:left;"><span id="detailbox_client"></span>さんの依頼</h1>
			<small style="float:right; margin-right: 100px;">投稿日時：<span id="detailbox_date"></span></small>
			<div class="clear-element"></div>
			<br>
			<br>
			<h4>カテゴリ : <span id="detailbox_category" style="font-size: 20px;"></span></h4>
			<h4>被告人 : <span id="detailbox_target" style="font-size: 20px;"></span></h4>
			<br>
			<h4>依頼詳細</h4>
			<p id="detailbox_detail" style="margin-right:3px; margin-left:3px">
			</p>
			<br>
			<button id="detailbox-accept" type="button" class="btn btn-success" style="margin-left:5px; margin-bottom:5px;">依頼を引き受ける</button>
		</div>
	  </div>

    <!-- 傍聴席 裁判中の案件一覧 -->
    <div id="chatplace">
      <div class="ui-container">
        <h1>傍聴席</h1>
		<p>コメントして裁判官の手助けをしよう!</p>
        <?php
          if(isset($_SESSION['login_name'])){
            // SQLクエリ
            $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");

            $query = "SELECT r.title, u.login_name, c.category_name, j.id
                      FROM users u, judge j, request r, category c
                      WHERE u.id=j.master AND r.id=j.request AND c.id=r.category
                      AND j.master IS NOT NULL AND j.result IS NULL";
            $result = pg_prepare($conn, "chat_select", $query);
            $result = pg_execute($conn, "chat_select", array());
            $num = pg_num_rows($result);
            // テーブルヘッダ
            print "<div style=\"height:100%; overflow-y:scroll; height: 30vh;\">";
            print "<table class=\"table table-striped\"><thead>";
            print "<tr>";
            print "<th scope=\"col\">タイトル</th>";
            print "<th scope=\"col\">裁判官</th>";
            print "<th scope=\"col\">カテゴリ</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";
            for($i=0;$i<$num;$i++){
              $row=pg_fetch_assoc($result, $i);
              print "<tr>";
              print "<td><a href=\"#\" onclick=\"clickChat({$row['id']}); return false;\">";
              echo  htmlspecialchars( $row['title'], ENT_QUOTES, 'UTF-8' );
              print "</a></td>";
              print "<td>";
              echo  htmlspecialchars( $row['login_name'], ENT_QUOTES, 'UTF-8' );
              print "</td>";
              print "<td>";
              echo  htmlspecialchars( $row['category_name'], ENT_QUOTES, 'UTF-8' );
              print "</td>";
              print "</tr>";
            }
            print "</tbody>";
            print "</table>";
            print "</div>";
          }
        ?>
        <!-- 傍聴席詳細  ここでコメントができる-->
        <div id="chat_detail">
          <!-- 説明書き -->
          <div id="chat_explain" style="margin-bottom:64px;">
            <div style="border-style: dotted;">
        			<h1><span id="chat_detail_client"></span>さんの依頼</h1>
        			<br>
        			<br>
        			<h4>カテゴリ : <span id="chat_detail_category" style="font-size: 20px;"></span></h4>
              <h4>被告人 : <span id="chat_detail_target" style="font-size: 20px;"></span></h4>
        			<br>
        			<h4>依頼詳細</h4>
        			<p id="chat_detail_detail" style="margin-right:3px; margin-left:3px">
        			</p>
        		</div>
          </div>
          <div id="chat_submit">
          </div>
          <div id="chat_box" class="ui-container" style="border-style: solid; margin:8px">
            <!-- ここに動的にHTMLを加える -->
          </div>
        </div>
      </div>
    </div>

	  <!-- 判例一覧　裁判を終えたものリスト -->
	  <div id="judged_list">
  		<div class="ui-container">
  			<h1>判例一覧</h1>
			<p>判決を下す際の参加資料にどうぞ</p>
        <?php
          if(isset($_SESSION['login_name'])){
            // SQLクエリ
            $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
            $query = "SELECT j.id, r.title, u.login_name AS plaintiff, r.target, m.login_name AS judgemaster, j.result
                      FROM request r, users u, users m, judge j
                      WHERE u.id=r.client AND r.id=j.request AND j.master=m.id
                      AND j.result IS NOT NULL";
            $result = pg_prepare($conn, "result", $query);
            $result = pg_execute($conn, "result", array());
            $num = pg_num_rows($result);
            // テーブルヘッダ
            print "<table class=\"table table-striped\"><thead>";
            print "<tr>";
            print "<th scope=\"col\">タイトル</th>";
            print "<th scope=\"col\">原告</th>";
            print "<th scope=\"col\">被告</th>";
            print "<th scope=\"col\">裁判官</th>";
            print "<th scope=\"col\">判決</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";
            for($i=0;$i<$num;$i++){
              $row=pg_fetch_assoc($result, $i);
              print "<tr>";
              print "<td><a href=\"#\" onclick=\"judgedDetail({$row['id']}); return false;\">";
              echo  htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
              print "</a></td>";
              print "<td>";
              echo  htmlspecialchars($row['plaintiff'], ENT_QUOTES, 'UTF-8');
              print "</td>";
              print "<td>";
              echo htmlspecialchars($row['target'], ENT_QUOTES, 'UTF-8');
              print "</td>";
              print "<td>";
              echo htmlspecialchars($row['judgemaster']);
              print "</td>";
              if($row['result']==1){
                print "<td>有罪</td>";
              }else {
                print "<td>無罪</td>";
              }
              print "</tr>";
            }
            print "</tbody>";
            print "</table>";
          }
        ?>
  		</div>
	  </div>

    <!-- 判例詳細 -->
    <div id="judged_detail">
      <div class="ui-container" style="border-style: dotted; margin:8px">
  			<h1 style="float:left;"><<span id="judged_detail_title"></span>></h1>
  			<div class="clear-element"></div>
  			<br>
  			<h4>裁判官：<span id="judged_detail_master" style="font-size: 20px;"></span></h4>
        <h4>原告：<span id="judged_detail_plaintiff" style="font-size: 20px;"></span></h4>
        <h4>被告：<span id="judged_detail_target" style="font-size: 20px;"></span></h4>
  			<h4>依頼詳細</h4>
  			<p id="judeged_detail_detail" style="margin-right:3px; margin-left:3px">
  			</p>
        <br>
        <h4>判決：<span id="judged_detail_result" style="font-size: 20px;"></span></h4>
        <h4>判決理由</h4>
  			<p id="judeged_detail_reason" style="margin-right:3px; margin-left:3px">
  			</p>
  			<br>
  			<button id="judged_detail_good" type="button" class="btn btn-success" style="margin-left:5px; margin-bottom:5px;">いいね</button>
  		</div>
    </div>

	<!--裁判官ランキング -->
    <div id="ranking">
      <div class="ui-container">
        <h1>裁判官ランキング</h1>
		<p>いい判決をしてランキングTOPを目指せ!</p>
		<p>スコア = いいねの獲得数　÷　判決した案件の数</p>
		<?php
          if(isset($_SESSION['login_name'])){
            // SQLクエリ
            $conn = pg_connect("host=localhost user=j161691k dbname=j161691k");
            $query = "SELECT u.login_name, a.eval_avg FROM users u, user_score_avg a
							WHERE u.id=a.id AND a.eval_avg IS NOT NULL ORDER BY a.eval_avg DESC";
            $result = pg_prepare($conn, "ranking_select", $query);
            $result = pg_execute($conn, "ranking_select", array());
            $num = pg_num_rows($result);
            // テーブルヘッダ
            print "<table class=\"table table-striped\"><thead>";
            print "<tr>";
			print "<th scope=\"col\">順位</th>";
            print "<th scope=\"col\">ユーザー名</th>";
            print "<th scope=\"col\">スコア</th>";
            print "</tr>";
            print "</thead>";
            print "<tbody>";
            for($i=0;$i<$num;$i++){
				  $row=pg_fetch_assoc($result, $i);
				  print "<tr>";
				  print "<td>";
				  $rank = $i + 1;
				  print "{$rank}";
				  print "</td>";
				  print "<td>";
				  echo  htmlspecialchars($row['login_name'], ENT_QUOTES, 'UTF-8');
				  print "</td>";
				  print "<td>";
				  print "{$row['eval_avg']}";
				  print "</td>";
			}	
			print "</tbody>";
			print "</table>";
		  }
        ?>
      </div>
    </div>

      <!-- パスワード変更 -->
      <div id="changepass">
        <div class="ui-container">
          <div class="jumbotron">
            <h1 class="display-4">パスワード変更</h1>
            <p class="lead">現在のパスワードと新しいパスワードを入力してください</p>
            <hr class="my-4">
            <form action="#" method="post">
              <div class="form-group">
                <table>
                  <tr>
                    <td><span>現在のパスワード</span></td>
                    <td><input pattern="^[0-9A-Za-z]+$" type="password" class="form-control" id="pwd" placeholder="current password"></td>
                  </tr>
                  <tr>
                    <td><span>新しいパスワード</span></td>
                    <td><input pattern="^[0-9A-Za-z]+$" type="password" class="form-control" id="newpwd" placeholder="new password"></td>
                  </tr>
                  <tr>
                    <td><button id="change-button" type="button" class="btn btn-success">登録</button></td>
                    <td></td>
                  </tr>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="clear-element"></div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/start.js"></script>
  </body>
</html>
