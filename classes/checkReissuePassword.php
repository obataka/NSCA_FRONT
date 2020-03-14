<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_token_front.php';


$kaiin_no = '';


// POSTデータを取得
$token = htmlentities($_POST['token'], ENT_QUOTES, "UTF-8");

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}

if($kaiin_no != ""){ // ログイン中

}else{               // 変更依頼メールから 

	// データ取得処理
	$result = (new Tb_kaiin_token_front())->findBytoken($token);
	// 登録用会員番号生成用の連番を設定
	if ($result['kaiin_no'] != '') {
	    $kaiin_no = $result['kaiin_no'];
	}

}



echo $kaiin_no;

die();
