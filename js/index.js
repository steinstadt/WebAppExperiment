$(function() {
  // 全体表示
  $("body").fadeIn(1000);
  // #login以外のUIを非表示にする
  $("#regist-ui").hide();
  $("#login-success").hide();

  $("#register").click(function() {
      // 新規登録画面の表示
      $("#login").fadeOut(800);
      $("#regist-ui").delay(800).fadeIn(800);
  });

  // ログインボタンが押された時、PHPで確認
  $("#ajaxlogin").click(function() {
    // Ajax通信を開始
    $.ajax({
      url: './login/login_check.php',
      type: 'post',
      dataType: 'json',
      data: {
        login_name: $('#login_name').val(),
        pwd: $('#pwd').val(),
      },
    })
    //Ajax通信が成功
    .done(function(response) {
      if (response.data == '1') {
        // ログイン成功
        // スタート画面へ
        $("body").fadeOut(1000);
        setTimeout(function() {
          window.location.href='./start.php';
        }, 2000);

      }else {
        // ログイン失敗
        console.log("login failed");
        alert("ユーザー名もしくはパスワードが間違っています！");
      }
    })
    //Ajax通信が失敗
    .fail(function() {
		alert("ユーザー名もしくはパスワードが間違っています！");
    });
  });

  // 新規登録ボタンが押された時、PHPで処理
  $("#regist-button").click(function (){
    // Ajax通信を開始
    $.ajax({
      url: './regist/regist_check.php',
      type: 'post',
      dataType: 'json',
      data: {
        login_name: $('#regist_login_name').val(),
        pwd: $('#regist_pwd').val(),
      },
    })
    .done(function(response) {
      console.log("ajax success");
      // ログイン画面に戻る
      alert("登録が完了しました");
      $("#regist-ui").hide();
      $("#login").show();
    })
    .fail(function() {
      console.log("ajax failed");
    });
  });

  // 新規登録画面->login
  $("#regist-to-login").click(function() {
    $("#regist-ui").fadeOut(800);
    $("#login").delay(800).fadeIn(800);
  });
});
