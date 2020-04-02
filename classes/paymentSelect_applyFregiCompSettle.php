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
require './DBAccess/Tb_kessai_hakko.php';

$cm_control = new Cm_control();
$tb_kaiin_joho = new Tb_kaiin_joho();
$tb_kessai_hakko = new Tb_kessai_hakko();
$result = null;

/*************************************************************************************************************************************
* SESSIONデータを取得
*************************************************************************************************************************************/
$tranScreen = isset($_SESSION['tranScreen']) ? $_SESSION['tranScreen'] : '';
$memberType = isset($_SESSION['member_type']) ? $_SESSION['member_type'] : '';
$selOption = isset($_SESSION['sel_option']) ? $_SESSION['sel_option'] : '';
$keiriShumoku1 = isset($_SESSION['keiri_shumoku_cd_1']) ? $_SESSION['keiri_shumoku_cd_1'] : '';
$keiriShumoku2 = isset($_SESSION['keiri_shumoku_cd_2']) ? $_SESSION['keiri_shumoku_cd_2'] : '';

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

$fregiId = paymentSelect_functions::getFregiId();
if(empty($fregiId)) {
    echo false;
    die();
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

// F-REGI決済データの登録
if(!$tb_kessai_hakko->insertRec($fregiData)) {
    echo false;
    die();
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
                    $_SESSION['shimei_sei'],
                    $_SESSION['shimei_mei'],
                    $_SESSION['furigana_sei'],
                    $_SESSION['furigana_mei'],
                    $_SESSION['seinengappi']
                );

                if(!empty($oldKaiinNo)) $certificateFlg = 1;

                // 会員データの新規登録（会員番号をセッションに保存）
                $kaiinNo = paymentSelect_functions::insertMemberData($oldKaiinNo, $payType, $certificateFlg);
                if(empty($kaiinNo)) {
                    echo false;
                    die();
                }
                $_SESSION['kaiinNo'] = $kaiinNo;

                // 旧認定校性のデータを新規会員番号に更新
                if($certificateFlg == 1){
                    if(!paymentSelect_functions::updateMemberCertificate($oldKaiinNo)) {
                        echo false;
                        die();
                    }
                }

                // 会員選択データの登録
                if(!paymentSelect_functions::insertMemberSelectData) {
                    echo false;
                    die();
                }
                
                break;
        }
        break;
}



echo true;
die();