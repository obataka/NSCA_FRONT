<?php

namespace Was;

session_start();


require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_ceu_joho_meisai.php';


$ret = '';
$wk_no = 0;

$wk_kaiin_no = "";

//セッションから会員番号を取得
if (isset($_SESSION['kaiinNo'])) {

    // ログインしている時
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

$wk_kaiin_no = 10251033;

//personalDevelopmentConfirmでセットしたPOSTデータを取得する
$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";

// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();


// 更新用パラメーター設定
$param = [
    'ceu_id'                                    => $ceu_id,
    'kaiin_no'                                  => $wk_kaiin_no,
    'category_kbn'                              => 4,
    'keijo_kbn'                                 => 1,
];

//CEU取得日とCEU数取得
$ceu = (new Tb_ceu_joho_meisai())->findByCEUShutoku($db, $param);

$param = array_merge($param, array('ceusu'=>$ceu['ceusu']));
$param = array_merge($param, array('level_2_point'=>$ceu['level_2_point']));

//パーソナルディベロップメントの場合はCEU取得日を現在日時とする
if ($ceu['event_kbn'] == 10) {
    $shutokubi = date("Y/m/d");
} else {
    $shutokubi = $ceu['shutokubi'];
}

//TBCEU情報明細のレコード存在確認
$ceu_exists = (new Tb_ceu_joho_meisai())->chkExistsJoho($db, $param);

// error_log(print_r($ceu, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');

//レコードがあれば更新、なければ追加
if (!empty($ceu_exists)) {
    // 更新処理
    $result = (new Tb_ceu_joho_meisai())->updateRecCEUJoho($db, $param, $shutokubi);
    // 更新失敗の場合
    if ($result == false) {
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
        // 更新成功の場合
    } else {
        // commit
        $db->commit();

        // 戻り値に1設定
        $result = 1;
    }
} else {
    //参加者区分のセット
    if (strpos($param['kaiin_no'], 70) === 0) {
        $sankasha_kbn = 3;
    } else {
        $sankasha_kbn = 1;
    }

    // 追加処理
    $result = (new Tb_ceu_joho_meisai())->insertRecCEUJoho($db, $param, $shutokubi, $sankasha_kbn);
    // 追加失敗の場合
    if ($result == false) {
        // ロールバック
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
        // 追加成功の場合
    } else {
        // commit
        $db->commit();

        // 戻り値に1設定
        $result = 1;
    }
}



echo $result;
die();
