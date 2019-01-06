<?php
  session_name("j161691k");
  session_start();
?>
<!-- 新規ユーザー登録・ログイン -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/login.css">
    <title>ログイン画面(情報工学実験)</title>
  </head>
  <body>
    <!-- スタート画面 -->
    <div class="screen-container">
      <!-- 左画面 -->
      <div id="design">
		<img src="./images/sample.jpg" alt="サンプル画像" style="width:440px; height:60px">
		<hr>
        <div id="web-title">
          <h1 style="font-family: 'Myfont'">Community Judge!</h1>
		  <p style="font-family: 'Myfont'; font-size:30px;">~Let's help worrying people as a judgemaster~</p>
          <br>
		  <h2>Community Judgeとは</h2>
		  <p>　Community Judgeとは、ユーザーが裁判官としてあらゆる案件の善悪を判断する、
		  裁判シミュレーションアプリです。ユーザーの依頼(恋愛、教育、商売)に対して依頼の当事者(ユーザーが
		  迷惑だと思っているもの)が本当に悪いのか、もし無罪ならばなぜなのかを裁判官は判断してもらいます</p>
		  <br>
		  <h2>このアプリが求められるわけ</h2>
		  <p>　このアプリは「お金をかけずに揉め事を解決したい」という方に求められるでしょう。
		  というのは、第三者が法律だけでなく感情論や常識を総合的に踏まえて解決してくれるからです。
		  しばしば慰謝料や商売の関係で裁判沙汰になりますが、法律が難解すぎて判決が下されたとしても
		  原告または被告にとっては納得のいかない結果になるかもしれません。しかし、Community Judgeは
		  そうではありません。第三者のユーザーがお互いに納得のいく答えを導いてくれるでしょう！</p>
		  <br>
		  <h2>あなたはどっち？</h2>
		  <p>あなたは、「依頼人」または「裁判官」または「傍聴人」としてこのアプリを利用します。「依頼人」としてアプリを
		  使う場合、メインページの「依頼投稿」「依頼一覧」「判例一覧」を利用しましょう。「裁判官」として
		  使う場合、メインページの「引き受け依頼一覧」「傍聴席」「判例一覧」を利用しましょう。「傍聴人」として
		  使う場合、メインページの「傍聴席」を利用しましょう。</p>
		  <br>
		  <h2>各機能の使い方</h2>
		  <p>以下にCommunity Judgeの各機能について紹介します。</p>
		  <ul>
			<li>
				<h3>新規登録</h3>
				<p>新規登録ページよりアカウントを取得できます。</p>
			</li>
			<li>
				<h3>依頼投稿</h3>
				<p>悩み事を依頼できます。</p>
			</li>
			<li>
				<h3>依頼一覧</h3>
				<p>投稿された未判決の依頼を閲覧できます。また、ここから依頼を引き受けることができます。</p>
			</li>
			<li>
				<h3>引き受け依頼一覧</h3>
				<p>引き受けた依頼の一覧が表示されます。</p>
			</li>
			<li>
				<h3>傍聴席</h3>
				<p>審議中の裁判を閲覧できます。また、コメント投稿を通じて裁判官に意見を述べることができます。</p>
			</li>
			<li>
				<h3>判例一覧</h3>
				<p>判決が下された案件の一覧が表示されます。また、良い判決に対して「いいね」をすることができます。
				いいね機能を使ってCommunity Judgeを盛り上げましょう!</p>
			</li>
			<li>
				<h3>裁判官ランキング</h3>
				<p>いいねの平均獲得数で比較されたランキングを閲覧できます。上位を目指すために責任をもって
				依頼に取り組みましょう!</p>
			</li>
			<li>
				<h3>パスワード変更</h3>
				<p>パスワード変更をしたい場合、現在のパスワードと新しいパスワードを入力してください</p>
			</li>
		  </ul>
        </div>
      </div>

      <!-- 右画面 -->
      <div id="menu">
		<img src="./images/sample.jpg" alt="サンプル画像" style="width:440px; height:60px">
		<hr>
        <!-- ログインUI -->
        <div id="login">
          <div class="ui-container">
            <div class="jumbotron">
              <h1 class="display-4">ログインパーツ</h1>
              <p class="lead">ログインをすることで本アプリを体験できます。アカウントをお持ちでない場合は新規作成をお願いいたします。</p>
              <hr class="my-4">
              <form action="#" method="post">
                <div class="form-group">
                  <table>
                    <tr>
                      <td><span>ユーザー名</span></td>
                      <td><input pattern="^[0-9A-Za-z]+$" type="text" class="form-control" id="login_name" placeholder="username"></td>
                    </tr>
                    <tr>
                      <td><span>パスワード</span></td>
                      <td><input pattern="^[0-9A-Za-z]+$" type="password" class="form-control" id="pwd" placeholder="password"></td>
                    </tr>
                    <tr>
                      <td><button id="ajaxlogin" type="button" class="btn btn-success">ログイン</button></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </form>
              <br>
              <button id="register" type="button" class="btn btn-success">新規登録はこちらから</button>
            </div>
          </div>
        </div>
        <!-- 新規登録画面 -->
        <div id="regist-ui">
          <div class="ui-container">
            <div class="jumbotron">
              <h1 class="display-4">新規登録</h1>
              <p class="lead">ユーザー名とパスワードを入力してください。</p>
              <hr class="my-4">
              <form action="#" method="post">
                <div class="form-group">
                  <table>
                    <tr>
                      <td><span>ユーザー名</span></td>
                      <td><input pattern="^[0-9A-Za-z]+$" type="text" class="form-control" id="regist_login_name" placeholder="username"></td>
                    </tr>
                    <tr>
                      <td><span>パスワード</span></td>
                      <td><input pattern="^[0-9A-Za-z]+$" type="password" class="form-control" id="regist_pwd" placeholder="password"></td>
                    </tr>
                    <tr>
                      <td><button id="regist-button" type="button" class="btn btn-success">登録</button></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </form>
            </div>
          </div>
          <button id="regist-to-login" type="submit" class="btn btn-success" style="margin-left:8px;">ログイン画面へ戻る</button>
        </div>
        <!-- 新規登録画面終わり -->
      </div>
      <div class="clear-element"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/index.js"></script>
  </body>
</html>
