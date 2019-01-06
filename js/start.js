$(function() {
  // 全体表示
  $("body").fadeIn(1000);
  $("#changepass").hide();
  $("#requestpost").hide();
  $("#requestlist").hide();
  $("#detailbox").hide();
  $("#judged_list").hide();
  $("#judged_detail").hide();
  $("#chatplace").hide();
  $("#chat_detail").hide();
  $("#ranking").hide();

  // ユーザー情報画面への遷移
  $("#user").click(function() {
    $("#changepass").fadeOut(800);
    $("#requestpost").fadeOut(800);
  	$("#requestlist").fadeOut(800);
  	$("#detailbox").fadeOut(800);
  	$("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").fadeOut(800);
    $("#userinfo").delay(800).fadeIn(800);
  });

  // 依頼投稿画面への遷移
  $("#postreq").click(function() {
    $("#userinfo").fadeOut(800);
    $("#changepass").fadeOut(800);
  	$("#requestlist").fadeOut(800);
  	$("#detailbox").fadeOut(800);
  	$("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").fadeOut(800);
    $("#requestpost").delay(800).fadeIn(800);
  });

  // 依頼一覧画面への遷移
  $("#listreq").click(function() {
	  $("#userinfo").fadeOut(800);
	  $("#requestpost").fadeOut(800);
	  $("#changepass").fadeOut(800);
	  $("#detailbox").fadeOut(800);
	  $("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").fadeOut(800);
	  $("#requestlist").delay(800).fadeIn(800);
  });

  // 判例一覧画面への遷移
  $("#judgelist").click(function(){
	  $("#userinfo").fadeOut(800);
	  $("#requestpost").fadeOut(800);
	  $("#changepass").fadeOut(800);
	  $("#detailbox").fadeOut(800);
	  $("#requestlist").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").fadeOut(800);
	  $("#judged_list").delay(800).fadeIn(800);
  });

  // パスワード変更画面への遷移
  $("#password").click(function() {
    $('#userinfo').fadeOut(800);
    $("#requestpost").fadeOut(800);
  	$("#requestlist").fadeOut(800);
  	$("#detailbox").fadeOut(800);
  	$("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").fadeOut(800);
    $('#changepass').delay(800).fadeIn(800);
  });

  // 傍聴席画面への遷移
  $("#chat").click(function() {
    $("#userinfo").fadeOut(800);
    $("#requestpost").fadeOut(800);
    $("#requestlist").fadeOut(800);
    $("#detailbox").fadeOut(800);
    $("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#changepass").fadeOut(800);
    $("#ranking").fadeOut(800);
    $("#chatplace").delay(800).fadeIn(800);
  });

  // ランキング画面への遷移
  $("#masterrank").click(function() {
    $("#userinfo").fadeOut(800);
    $("#requestpost").fadeOut(800);
    $("#requestlist").fadeOut(800);
    $("#detailbox").fadeOut(800);
    $("#judged_list").fadeOut(800);
    $("#judged_detail").fadeOut(800);
    $("#changepass").fadeOut(800);
    $("#chatplace").fadeOut(800);
    $("#ranking").delay(800).fadeIn(800);
  });

  // 依頼投稿ボタンを押す
  $("#post-button").click(function() {
    // Ajax 通信
    $.ajax({
      url: './post/post_check.php',
      type: 'get',
      dataType: 'json',
      data: {
        title: $("#requesttitle").val(),
        category: $("#requestcategory").val(),
        detail: $("#requestdetail").val(),
		target: $("#requesttarget").val(),
      },
    })
    //Ajax通信が成功
    .done(function(response) {
      if (response.data == '1') {
        // 投稿成功
        alert("投稿しました");
        $("#requesttitle").val("");
        $("#requestcategory").val("1");
        $("#requestdetail").val("");
		    $("#requesttarget").val("");
        $("body").fadeOut(1000);
        setTimeout(function() {
          window.location.href='./start.php';
        }, 2000);
      }else {
        // 投稿失敗
        alert("依頼投稿に失敗しました");
      }
    })
    //Ajax通信が失敗
    .fail(function() {
      console.log("ajax failed");
	          // 投稿成功
        alert("投稿しました");
        $("#requesttitle").val("");
        $("#requestcategory").val("1");
        $("#requestdetail").val("");
		    $("#requesttarget").val("");
        $("body").fadeOut(1000);
        setTimeout(function() {
          window.location.href='./start.php';
        }, 2000);
    });

    return false;
  });

  // パスワード変更
  $("#change-button").click(function() {
    // Ajax 通信
    $.ajax({
      url: './password/change_password.php',
      type: 'post',
      dataType: 'json',
      data: {
        pwd: $('#pwd').val(),
        newpwd: $('#newpwd').val(),
      },
    })
    //Ajax通信が成功
    .done(function(response) {
      if (response.data == '1') {
        // パスワード変更成功
        alert("パスワード変更しました");
        $('#pwd').val("");
        $('#newpwd').val("");

      }else {
        // パスワード変更失敗
        alert("パスワード変更に失敗しました");
      }
    })
    //Ajax通信が失敗
    .fail(function() {
      console.log("ajax failed!");
    });
  });

// ログアウト
$("#logout").click(function() {
  // Ajax 通信
  $.ajax({
    url: './logout/logout.php',
    type: 'post',
    dataType: 'json',
    data: {
      logdata: "logdata",
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    if (response.data == '1') {
      // ログアウト成功
      // ログイン画面へ
      $("body").fadeOut(1000);
      setTimeout(function() {
        window.location.href='./';
      }, 2000);

    }else {
      // ログイン失敗
      console.log("logout failed");
      alert("ログアウトに失敗しました");
    }
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
});

// 検索ボタンのイベント
$("#requestlist_button").click(function(){
	// 検索開始
	$.ajax({
    url: './post/search_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      keyword: $("#requestlist_keyword").val(),
	  category: $("#requestlist_category").val(),
    },
  })
  //Ajax通信が成功
  .done(function(response) {
	// 動的にテーブルを加える
    let outputHTML = "";
    $("#request_list_change").html(outputHTML);
    outputHTML = "<table class=\"table table-striped\""
                + "<thead><tr>"
                + "<tr><th scope=\"col\">投稿者</th>"
                + "<th scope=\"col\">タイトル</th>"
				+ "<th scope=\"col\">カテゴリ</th></tr></thead>";
    outputHTML += "<tbody>";
    for(let i=0; i < Object.keys(response.data).length; i++){
      let accessElem = "key"+ i;
      outputHTML += "<tr><td>" + htmlspecialchars(response.data[accessElem]['login_name']) + "</td>"
                  + "<td>" + htmlspecialchars(response.data[accessElem]['title']) + "</td>"
				  + "<td>" + htmlspecialchars(response.data[accessElem]['category_name']) + "</td></tr>";
    }
    outputHTML += "</tbody></table>";
    $("#request_list_change").append(outputHTML);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
});

});
// 実行予約イベント終了

// 詳細画面の表示
function clickDetail(id){
	// Ajax通信
	$.ajax({
    url: './post/detail_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      req_id: id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
	// 値の割り当て
  let login_name = htmlspecialchars(response.detail_array.login_name);
  let detail = htmlspecialchars(response.detail_array.detail);
  let target = htmlspecialchars(response.detail_array.target);
	$("#detailbox_client").text(login_name);
	$("#detailbox_date").text(response.detail_array.client_time);
	$("#detailbox_category").text(response.detail_array.category_name);
	$("#detailbox_detail").text(detail);
  $("#detailbox_target").text(target);

	// イベントの割り当て
	let clickEvent = "clickRequestAccept(" + id +")";
	$("#detailbox-accept").attr("onclick", clickEvent);

	$("#requestlist").fadeOut(800);
	$("#detailbox").delay(800).fadeIn(800);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// 依頼引き受けボタンのイベント
function clickRequestAccept(id){
	// Ajax通信
	$.ajax({
    url: './post/accept_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      req_id: id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
	  // ユーザー画面に戻る
	  $("#detailbox").fadeOut(800);
	  setTimeout(function() {
          window.location.href='./start.php';
        }, 1000);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// 判決ボタンのイベント
function clickToJudge(judge_id){
	let id = "#judge" + judge_id;
	let judgeButton = "#judge-button" + judge_id;
	let answerEvent = "clickAnswer(" + judge_id + ")";
	$(id).slideToggle(200);
	// 回答のイベント
	$(judgeButton).attr("onclick", answerEvent);
	$(judgeButton).text('判決を下す');
}

// 判決ボタンのイベント（回答）
function clickAnswer(judge_id){
	console.log("clickAnswer event called " + judge_id);
	let judge_result_value = "*[name=judge_result" + judge_id + "]:checked";
	let judge_reason_value = "#judge_reason" + judge_id;
	// Ajax通信
	$.ajax({
    url: './post/judge_check.php',
    type: 'post',
    dataType: 'json',
    data: {
	  judge_id : judge_id,
      judge_result : $(judge_result_value).val(),
	  judge_reason : $(judge_reason_value).val(),
    },
  })
  //Ajax通信が成功
  .done(function(response) {
		alert("判決を下しました。");
		// リロード処理を施す
		setTimeout(function() {
          window.location.href='./start.php';
        }, 1000);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// 判例詳細画面のイベント
function judgedDetail(id) {
  // Ajax通信
	$.ajax({
    url: './post/judged_detail_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      judge_id: id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    // 値の割り当て
    let title = htmlspecialchars(response.detail_array.title);
    let master = htmlspecialchars(response.detail_array.master);
    let plaintiff = htmlspecialchars(response.detail_array.plaintiff);
    let target = htmlspecialchars(response.detail_array.target);
    let detail = htmlspecialchars(response.detail_array.detail);
    let reason = htmlspecialchars(response.detail_array.reason);
    $("#judged_detail_title").text(title);
    $("#judged_detail_master").text(master);
    $("#judged_detail_plaintiff").text(plaintiff);
    $("#judged_detail_target").text(target);
    $("#judeged_detail_detail").text(detail);
    $("#judged_detail_result").text(response.detail_array.result);
    $("#judeged_detail_reason").text(reason);

    // イベントの割り当て
    let clickEvent = "goodButton(" + id +")";
    $("#judged_detail_good").attr("onclick", clickEvent);

  	$("#judged_list").fadeOut(800);
  	$("#judged_detail").delay(800).fadeIn(800);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// いいねボタン機能
function goodButton(judge_id) {
  // Ajax通信
	$.ajax({
    url: './post/good_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      judge_id: judge_id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    alert("いいねしました！");
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// 傍聴席詳細
function clickChat(judge_id) {
  // 説明書きの作成
  $.ajax({
    url: './post/chat_detail_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      judge_id: judge_id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    let client = htmlspecialchars(response.detail_array.login_name);
    let target = htmlspecialchars(response.detail_array.target);
    let detail = htmlspecialchars(response.detail_array.detail);
    $("#chat_detail_client").text(client);
    $("#chat_detail_category").text(response.detail_array.category_name);
    $("#chat_detail_target").text(target);
    $("#chat_detail_detail").text(detail);
    $("#chat_detail").show();
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });

  // チャット画面の生成
	$.ajax({
    url: './post/chat_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      judge_id: judge_id,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    // 動的にテーブルを加える
    let outputHTML = "";
    let outputSubmit = "";
    $("#chat_box").html(outputHTML);
    $("#chat_submit").html(outputSubmit);
    outputHTML = "<table class=\"table table-striped\""
                + "<thead><tr>"
                + "<tr><th scope=\"col\">ユーザー</th>"
                + "<th scope=\"col\">コメント</th></tr></thead>";
    outputHTML += "<tbody>";
    for(let i=0; i < Object.keys(response.data).length; i++){
      let accessElem = "key"+ i;
      outputHTML += "<tr><td>" + htmlspecialchars(response.data[accessElem]['login_name']) + "</td>"
                  + "<td>" + htmlspecialchars(response.data[accessElem]['message']) + "</td></tr>";
    }
    outputHTML += "</tbody></table>";
    $("#chat_box").append(outputHTML);
    outputSubmit = "<input id=\"comment" + judge_id + "\" type=\"text\" class=\"form-control\" placeholder=\"コメント入力\">";
    outputSubmit += "<button type=\"button\" class=\"btn btn-success\" onclick=\"clickComment(" + judge_id +")\">コメント</button>";
    $("#chat_submit").append(outputSubmit);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

function clickComment(judge_id) {
  console.log("clickComment called");
  let accessElem = "#comment" + judge_id;
  let message = htmlspecialchars($(accessElem).val());
  // Ajax通信
	$.ajax({
    url: './post/comment_check.php',
    type: 'post',
    dataType: 'json',
    data: {
      judge_id: judge_id,
      message: message,
    },
  })
  //Ajax通信が成功
  .done(function(response) {
    // テーブルにタプルを加える
    // 動的にテーブルを加える
    let outputHTML = "";
    let outputSubmit = "";
    $("#chat_box").html(outputHTML);
    $("#chat_submit").html(outputSubmit);
    outputHTML = "<table class=\"table table-striped\" style=\"overflow-y:scroll;\""
                + "<thead><tr>"
                + "<tr><th scope=\"col\">ユーザー</th>"
                + "<th scope=\"col\">コメント</th></tr></thead>";
    outputHTML += "<tbody>";
    for(let i=0; i < Object.keys(response.data).length; i++){
      let accessElem = "key"+ i;
      outputHTML += "<tr><td>" + htmlspecialchars(response.data[accessElem]['login_name']) + "</td>"
                  + "<td>" + htmlspecialchars(response.data[accessElem]['message']) + "</td></tr>";
    }
    outputHTML += "</tbody></table>";
    $("#chat_box").append(outputHTML);
    outputSubmit = "<input id=\"comment" + judge_id + "\" type=\"text\" class=\"form-control\" placeholder=\"コメント入力\">";
    outputSubmit += "<button type=\"button\" class=\"btn btn-success\" onclick=\"clickComment(" + judge_id +")\">コメント</button>";
    $("#chat_submit").append(outputSubmit);
  })
  //Ajax通信が失敗
  .fail(function() {
    console.log("ajax failed!");
  });
}

// クロスサイトスクリプティング対策
function htmlspecialchars(str){
  return (str + '').replace(/&/g,'&amp;')
                   .replace(/"/g,'&quot;')
                   .replace(/'/g,'&#039;')
                   .replace(/</g,'&lt;')
                   .replace(/>/g,'&gt;');
}
