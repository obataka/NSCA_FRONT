<?php
namespace Was;

session_start();

require './Config/Config.php';
require './Config/FregiConfig.php';
require './paymentSelect_constants.php';
require './paymentSelect_functions.php';
require './DBAccess/Db.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Tb_kaiin_joho.php';
require './DBAccess/Tb_kaiin_jotai.php';
require './DBAccess/Tb_kaiin_journal.php';
require './DBAccess/Tb_kaiin_sonota.php';
require './DBAccess/Tb_kaiin_pick_up.php';
require './DBAccess/Tb_kaiin_nintei.php';
require './DBAccess/Tb_kaiin_yakushoku.php';
require './DBAccess/Tb_kaiin_ceu.php';
require './DBAccess/Tb_kaiin_sentaku.php';
require './DBAccess/Tb_keiri_joho.php';
require './DBAccess/Tb_kessai_hakko.php';
require './DBAccess/Tb_shiken.php';
require './DBAccess/Tb_shiken_meisai.php';
require './DBAccess/Tb_doga_konyusha_meisai.php';
require './DBAccess/Tb_ceu_conference_joho_meisai.php';
require './DBAccess/Tb_ceu_conference_koen_sankasha.php';
require './DBAccess/Tb_ceu_quiz_joho_meisai.php';
require './DBAccess/Tb_ceu_joho_meisai.php';
require './DBAccess/Tb_kako_shiken_joho_meisai.php';
require './DBAccess/Tb_kataho_gokaku.php';
require './DBAccess/Tb_nintei_meisai.php';

$cm_control = new Cm_control();
$tb_kaiin_joho = new Tb_kaiin_joho();
$tb_kessai_hakko = new Tb_kessai_hakko();
$result = null;

/*************************************************************************************************************************************
* SESSIONデータを取得
*************************************************************************************************************************************/
$tranScreen = isset($_SESSION['tranScreen']) ? $_SESSION['tranScreen'] : '';
$selOption = isset($_SESSION['sel_option']) ? $_SESSION['sel_option'] : '';
$keiriShumoku1 = '01';
$keiriShumoku2 = '01';
// $keiriShumoku1 = isset($_SESSION['keiri_shumoku_cd_1']) ? $_SESSION['keiri_shumoku_cd_1'] : '';
// $keiriShumoku2 = isset($_SESSION['keiri_shumoku_cd_2']) ? $_SESSION['keiri_shumoku_cd_2'] : '';

/*************************************************************************************************************************************
* POSTデータを取得
*************************************************************************************************************************************/
$payType = isset($_POST['pay_type']) ? $_POST['pay_type'] : '';

/*************************************************************************************************************************************
* 
* title ：新規F-REGI決済処理
* return：true 成功 / false 失敗
*
**************************************************************************************************************************************/

// トランザクション開始
$db = Db::getInstance();
$db->beginTransaction();

try {
    // F-REGI決済番号の取得
    $fregiId = paymentSelect_functions::getFregiId($db);
    if(empty($fregiId)) {
        throw new Exception();
    }

    // 登録データを設定
    $fregiData = array();
    $fregiData['shop_id'] = FregiConfig::SHOP_ID;
    $fregiData['id'] = $fregiId;
    $fregiData['pay'] = isset($_SESSION['pay']) ? $_SESSION['pay'] : '';
    $fregiData['user_name_1'] = isset($_SESSION['shimei_sei']) ? $_SESSION['shimei_sei'] : '';
    $fregiData['user_name_2'] = isset($_SESSION['shimei_mei']) ? $_SESSION['shimei_mei'] : '';
    $fregiData['user_name_kana_1'] = isset($_SESSION['furigana_sei']) ? $_SESSION['furigana_sei'] : '';
    $fregiData['user_name_kana_2'] = isset($_SESSION['furigana_mei']) ? $_SESSION['furigana_mei'] : '';
    $fregiData['user_tel'] = isset($_SESSION['user_tel']) ? $_SESSION['user_tel'] : '';
    $fregiData['user_mail'] = null;
    $fregiData['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    $fregiData['auth_key'] = isset($_SESSION['auth_key']) ? $_SESSION['auth_key'] : '';
    $fregiData['item_title'] = isset($_SESSION['item_title']) ? $_SESSION['item_title'] : '';
    $fregiData['item_name'] = isset($_SESSION['item_name']) ? $_SESSION['item_name'] : '';
    $fregiData['item_name_kana'] = isset($_SESSION['item_name_kana']) ? $_SESSION['item_name_kana'] : '';
    $fregiData['expire'] = isset($_SESSION['expire']) ? $_SESSION['expire'] : '';
    $fregiData['char_code'] = FregiConfig::CHAR_CODE;
    $fregiData['settleno'] = null; // ASP版では、F-REGIにリダイレクトしたあと取得している模様
    $fregiData['seq_no'] = null;
    $fregiData['pay_ment_type'] = null;
    $fregiData['auth_code'] = null;
    $fregiData['status'] = null;
    $fregiData['ua'] = null;
    $fregiData['ceu_id'] = isset($_SESSION['ceu_id']) ? $_SESSION['ceu_id'] : '';
    $fregiData['ceu_meisai_id'] = isset($_SESSION['ceu_meisai_id']) ? $_SESSION['ceu_meisai_id'] : '';
    $fregiData['shiken_meisai_id'] = isset($_SESSION['shiken_meisai_id']) ? $_SESSION['shiken_meisai_id'] : '';
    $fregiData['zenshiken_meisai_id'] = isset($_SESSION['zenshiken_meisai_id']) ? $_SESSION['zenshiken_meisai_id'] : '';
    $fregiData['etc_id'] = isset($_SESSION['etc_id']) ? $_SESSION['etc_id'] : '';
    $fregiData['etc_meisai_id'] = isset($_SESSION['etc_meisai_id']) ? $_SESSION['etc_meisai_id'] : '';
    $fregiData['keiri_shumoku_cd_1'] = isset($_SESSION['keiri_shumoku_cd_1']) ? $_SESSION['keiri_shumoku_cd_1'] : '';
    $fregiData['keiri_shumoku_cd_2'] = isset($_SESSION['keiri_shumoku_cd_2']) ? $_SESSION['keiri_shumoku_cd_2'] : '';
    $fregiData['keiri_shumoku_cd_3'] = isset($_SESSION['keiri_shumoku_cd_3']) ? $_SESSION['keiri_shumoku_cd_3'] : '';
    $fregiData['kessai_kekka'] = null;
    $fregiData['error_code'] = null; // ASP版では、F-REGIにリダイレクトしたあと取得している模様
    $fregiData['error_message'] = null; // ASP版では、F-REGIにリダイレクトしたあと取得している模様
    $fregiData['kaiin_no'] = isset($_SESSION['kaiin_no']) ? $_SESSION['kaiin_no'] : '';
    $fregiData['sakujo_flg'] = 0;
    $fregiData['sakusei_user_id'] = $fregiData['koshin_user_id'] = paymentSelect_constants::USER_ID;
    $fregiData['sakusei_nichiji'] = $fregiData['koshin_nichiji'] = date('Y/m/d H:i:s');
    $fregiData['cscs_shikaku_koshinryo_nofu_kbn'] = null;
    $fregiData['cpt_shikaku_koshinryo_nofu_kbn'] = null;
    $fregiData['scsc_koshinryo'] = null;
    $fregiData['cpt_koshinryo'] = null;
    $fregiData['yoyaku_kaiin_sbt'] = null;
    $fregiData['konyubi'] = null;

    // 支払方法関係
    $fregiData['pay_type_specify'] = $payType;
    $payKbn = null;
    switch($payType) {
        case FregiConfig::PAY_TYPE_CARD :
            $fregiData['pay_mode_specify'] = FregiConfig::PAY_MODE_LUMP;
            $payKbn = Config::GEUM_PAY_CARD;
            break;
        case FregiConfig::PAY_TYPE_CONVENIENCE :
            $payKbn = Config::GEUM_PAY_CONVENIENCE;
            break;
    }

    // 各申込データの登録
    switch($keiriShumoku1) {
        case '01' :
            switch($keiriShumoku2) {
                case '01' :
                    $kaiinNo = null; // 会員番号
                    $oldKaiinNo = null; // 旧会員番号（認定校生）
                    $certificateFlg = 0; // 旧認定校生フラグ
                    $oldKaiinNo = paymentSelect_functions::getKaiinNoForMemberCertificate(
                        $_SESSION['name_sei'],
                        $_SESSION['name_mei'],
                        $_SESSION['name_sei_kana'],
                        $_SESSION['name_mei_kana'],
                        $_SESSION['seinengappi']
                    );

                    if(!empty($oldKaiinNo)) $certificateFlg = 1;

                    // 会員データの新規登録（会員番号をセッションに保存）
                    $kaiinNo = paymentSelect_functions::insertMemberData($db, $oldKaiinNo, $payType, $certificateFlg);
                    if(empty($kaiinNo)) {
                        // 会員番号が取得できない（会員登録処理の異常終了）場合はエラー
                        throw new Exception();
                    }
                    $_SESSION['kaiinNo'] = $kaiinNo;

                    // 旧認定校性のデータを新規会員番号に更新
                    if($certificateFlg == 1){
                        if(!paymentSelect_functions::updateMemberCertificate($db, $oldKaiinNo)) {
                            throw new Exception();
                        }
                    }
                    error_log(print_r('旧認定校生データ更新処理終了 ' .date('Y/m/d h:i:s'), true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
                    // 会員選択データの登録
                    if(!paymentSelect_functions::insertMemberSelectData($db)) {
                        error_log(print_r('選択データ追加失敗 ' .date('Y/m/d h:i:s'), true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
                        throw new Exception();
                    }
                        error_log(print_r('選択データ追加成功 ' .date('Y/m/d h:i:s'), true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
                    
                    // 経理伝票番号の取得
                    $keiriDempyoNo = paymentSelect_functions::getAccountingId($db);
                    if(empty($keiriDempyoNo)) {
                        throw new Exception();
                    }

                    // 経理情報の登録
                    if(!paymentSelect_functions::insertAccountingDataMember($db, $fregiData, $keiriDempyoNo, 0, null, false)) {
                        throw new Exception();
                    }

                    // 英文購読オプションがある場合
                    if($selOption == '1') {
                        // 経理情報データ登録（英文購読オプション専用）
                        if(!paymentSelect_functions::insertAccountingDataMember($db, $fregiData, $keiriDempyoNo, 0, null, true)) {
                            throw new Exception();
                        }
                    }

                    break;
            }
            break;
    }

    // F-REGI決済データの登録
    if(!$tb_kessai_hakko->insertRec_noTran($db, $fregiData)) {
        throw new Exception();
    }

    // F-REGI発行データ更新（付帯条件のセット）
    switch($keiriShumoku1.$keiriShumoku2) {
        case '0102' :
            break;
        case '0207' :
            break;
        case '0805' :
            break;
    }

    // メールを送信はそれぞれの決済完了画面から行う

} catch(Exception $e) {
    // 途中で例外が発生した場合、正しく値が取得できなかった場合、すべてロールバックする
    $db->rollback();
    echo false;
    die();
}

// トランザクション終了
$db->commit();
echo true;
die();