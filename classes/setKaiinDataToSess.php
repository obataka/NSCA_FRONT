<?php
namespace Was;

session_start();

require './Config/Config.php';
require './DBAccess/Db.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Tb_ceu_quiz_joho.php';
require './DBAccess/Tb_ceu_quiz_setsumon.php';

$wk_no = 0;



//POSTデータを取得
//confirmAnswer.jsでセットしたPOSTデータを取得する
// 会員情報
$ceu_id = (!empty($_POST['ceu_id'])) ? htmlentities($_POST['ceu_id'], ENT_QUOTES, "UTF-8") : "";
$ques_num1 = $_POST['ques_num'];
$ques_num = explode(",", $ques_num1);
//配列ques_num1をエスケープする
if (!empty($ques_num1)) {
    foreach((array)$ques_num1 as $key => $value) {
    $ques_num1[$key] = htmlentities($value, ENT_QUOTES);
    }
};


//セッションから会員番号を取得
$wk_kaiin_no = '';
if (isset($_SESSION['kaiinNo'])) {
   
    // ログインしている
    $wk_kaiin_no = $_SESSION['kaiinNo'];
}

/**********************
* パラメーター設定
***********************/
// DB接続
$db = Db::getInstance();

// トランザクション開始
$db->beginTransaction();

$param = [
    'kaiin_no'  => $wk_kaiin_no,
];

// データ取得処理
$result_kaiin = (new Tb_kaiin_joho())->findBykaiinjoho($param);


//会員情報取得成功の場合
if ($result_kaiin == TRUE) {

    //データ取得処理
    $result_Cm = (new Cm_control())->findByCmControl();
    
    //Cmコントロール取得成功の場合
    if ($result_Cm == TRUE) {
        
        //ceu_idをセット
        $param = [
            'ceu_id'  => $ceu_id,
        ];
        // データ取得処理
        $result_quizjoho = (new Tb_ceu_quiz_joho())->GetByQuizjoho($param);
        
        //クイズ情報取得成功の場合
        if ($result_quizjoho == TRUE) {
            
            $param = [
                'kaiin_no'  => $wk_kaiin_no,
                'ceu_id'  => $ceu_id,
            ];
            // データ取得処理
            $result_setsumon = (new Tb_ceu_quiz_setsumon())->findByQuizSetsumon($param);
            
            //設問情報取得成功の場合の場合
            if ($result_setsumon == TRUE) {
                
                //SESSIONに値をセットする
                $_SESSION['shimei'] = $result_kaiin['shimei_sei'] . $result_kaiin['shimei_mei'];
                $_SESSION['furigana'] = $result_kaiin['[furigana_sei]'] . $result_kaiin['[furigana_mei]'];
                
                //電話番号が空白ではなかったら、電話番号をセットする
                if ($result_kaiin['tel'] !== "") {
                    $_SESSION['tel'] = $result_kaiin['tel'];
                
                //電話番号が空白だったら、携帯番号をセットする
                } else {
                    $_SESSION['keitai_no'] = $result_kaiin['keitai_no'];
                };
                $_SESSION['sankaryo'] = $result_quizjoho['sankaryo'];
                $_SESSION['shutoku_naiyo'] = $result_quizjoho['[shutoku_naiyo] '] . $result_quizjoho['sankaryo'];
                $_SESSION['payeasy_mei'] = $result_quizjoho['[shutoku_naiyo] '] . $result_quizjoho['sankaryo'];
                $_SESSION['payeasy_kana'] = $result_quizjoho['[shutoku_naiyo] '] . $result_quizjoho['sankaryo'];
                $_SESSION['keiri1'] = "08";
                $_SESSION['keiri2'] = "02";
                $_SESSION['keiri3'] = "";
                $_SESSION['keiri3'] = "";
                $_SESSION['keiri3'] = $ceu_id;

                //設問数初期設定
                $n = 0;

                //正解数を求める
                for ($i = 0; $i < 50; $i++) {
                    
                    //選択肢が空になったらループ終了
                    if ($ques_num[$i] == "") {
                        break;
                    }

                    //選択肢と回答のアルファベットが一緒の場合、回答数+1
                    if ($ques_num[$i] ==  $result_setsumon[$i]['kaito_kbn']) {
                        $percent += 1;
                    }

                    //設問数count up
                    $n += 1;
                }
                
                //正答率を求める
                $percentage = ($percent / $n) * 100;

                //クイズ得点が正答率より上回っていた場合
                if ($result_Cm['quiz_tokuten'] > $percentage) {

                    //合否区分は2
                    $_SESSION['gohi_kbn'] = 2;
                
                //クイズ得点が正答率より下回っていた場合
                } else {

                    //合否区分は1
                    $_SESSION['gohi_kbn'] = 1;
                }
                $_SESSION['percentage'] = $percentage;

                

                // commit
                $db->commit();

                // 戻り値に1設定
                $result = 1;

            //設問情報取得失敗の場合
            } else {

                // ロールバック
                $db->rollBack();

                // 戻り値に0設定
                $result = 0;
            }
        
        //クイズ情報取得失敗の場合
        } else {

            // ロールバック
            $db->rollBack();

            // 戻り値に0設定
            $result = 0;
        }

    //Cmコントロール取得失敗の場合
    } else {
        // ロールバック
        $db->rollBack();

        // 戻り値に0設定
        $result = 0;
    }

//会員情報取得失敗の場合
} else {
    // ロールバック
    $db->rollBack();

    // 戻り値に0設定
    $result = 0;
}











//$return_value = -1;
// POSTデータを取得
// confirmMember.jsでセットしたPOSTデータからSESSIONにセット
// 入力された会員情報
$_SESSION['shimei'] = (!empty($_POST['shimei'])) ? htmlentities($_POST['shimei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['furigana'] = (!empty($_POST['furigana'])) ? htmlentities($_POST['furigana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['tel'] = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['sankaryo'] = (!empty($_POST['sankaryo'])) ? htmlentities($_POST['sankaryo'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['shutoku_naiyo'] = (!empty($_POST['shutoku_naiyo'])) ? htmlentities($_POST['shutoku_naiyo'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['payeasy_mei'] = (!empty($_POST['payeasy_mei'])) ? htmlentities($_POST['payeasy_mei'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['payeasy_kana'] = (!empty($_POST['payeasy_kana'])) ? htmlentities($_POST['payeasy_kana'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['keiri1'] = (!empty($_POST['keiri1'])) ? htmlentities($_POST['keiri1'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['keiri2'] = (!empty($_POST['keiri2'])) ? htmlentities($_POST['keiri2'], ENT_QUOTES, "UTF-8") : "";
$_SESSION['keiri3'] = (!empty($_POST['keiri3'])) ? htmlentities($_POST['keiri3'], ENT_QUOTES, "UTF-8") : "";


echo $result;
die();
