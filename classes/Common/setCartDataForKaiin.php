<?php

namespace Was;

session_start();

require '../Config/Config.php';
require '../DBAccess/Db.php';
require '../DBAccess/Cm_control.php';
require '../DBAccess/Tb_hambai_konyusha_joho_meisai.php';
require '../DBAccess/Tb_hambai_konyusha_joho.php';
require '../DBAccess/Tb_hambai_joho.php';


/************************************************************
*������ 
*************************************************************/
$konyusha_kbn = 1 ; // �w���ҋ敪�F���
$user_id = "products";
$gokei_kingaku = 0;
$soryo = 0;

$tb_hambai_konyusha_joho = new Tb_hambai_konyusha_joho();
$tb_hambai_konyusha_joho_meisai = new Tb_hambai_konyusha_joho_meisai();
$tb_hambai_joho = new Tb_hambai_joho();

/************************************************************
*�Z�b�V�����������ԍ�,�w��ID�擾 
*************************************************************/
$kaiin_no = "";
$konyu_id = "";

if (isset($_SESSION['kaiinNo'])) {
    $kaiin_no = $_SESSION['kaiinNo'];
}else{
	echo 0;
}

if (isset($_SESSION['konyu_id'])) {
    $konyu_id = $_SESSION['konyu_id'];
}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}else{
    $cart = [];
}

/************************************************************
*POST����w�����擾 
*************************************************************/

$hambai_id = (!empty($_POST['hambai_id'])) ? htmlentities($_POST['hambai_id'], ENT_QUOTES, "UTF-8") : "";
$hambai_kbn = (!empty($_POST['hambai_kbn'])) ? htmlentities($_POST['hambai_kbn'], ENT_QUOTES, "UTF-8") : "";
$size_kbn = (!empty($_POST['size_kbn'])) ? htmlentities($_POST['size_kbn'], ENT_QUOTES, "UTF-8") : "";
$color_kbn = (!empty($_POST['color_kbn'])) ? htmlentities($_POST['color_kbn'], ENT_QUOTES, "UTF-8") : "";
$hambai_sentakushi_kbn = (!empty($_POST['hambai_sentakushi_kbn'])) ? htmlentities($_POST['hambai_sentakushi_kbn'], ENT_QUOTES, "UTF-8") : "";
$kakaku = (!empty($_POST['kakaku'])) ? htmlentities($_POST['kakaku'], ENT_QUOTES, "UTF-8") : "";
$suryo = (!empty($_POST['suryo'])) ? htmlentities($_POST['suryo'], ENT_QUOTES, "UTF-8") : "";


/************************************************************
*cm_control���瑗���擾 
*************************************************************/

$CmControl = (new Cm_control())->findById(1);
// �Y���f�[�^�Ȃ��̏ꍇ
if (empty($CmControl)) {
	// �G���[
	return false;
}else{
	$cm_soryo = $CmControl['buppan_soyo'];
}


// DB�ڑ�
$db = Db::getInstance();

// �g�����U�N�V�����J�n
$db->beginTransaction();

/************************************************************
* �J�[�g���Ȃ��ꍇ�́A�V�K�ɔ̔��w���ҏ��A�̔��w���ҏ�񖾍ׂ��쐬����
*************************************************************/
if(empty($cart)){

	$soryo = $cm_soryo;
	$gokei_kingaku = $kakaku * $suryo + $soryo;

	//�w���ҏ��o�^
	$param = [
	    'kaiin_no'              => $kaiin_no,
	    'konyusha_kbn'          => $konyusha_kbn,
	    'gokei_kingaku'         => $gokei_kingaku,
	    'soryo'                 => $soryo,
	    'user_id'               => $user_id
	];
	$result = $tb_hambai_konyusha_joho->insert($db, $param);
	$konyu_id = $tb_hambai_konyusha_joho->getLastKonyuId($db);

	if(!$result || !$konyu_id){
		error_log(print_r("�w���ҏ��o�^�G���[", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
         $db->rollBack();
		 return false;
	}

	//�w���ҏ�񖾍דo�^

	$param_meisai = [
	    'konyu_id'                => $konyu_id,
	    'hambai_id'               => $hambai_id,
	    'hambai_size_kbn'         => $hambai_size_kbn,
	    'hambai_color_kbn'        => $hambai_color_kbn,
	    'hambai_sentakushi_kbn'   => $hambai_sentakushi_kbn,
	    'kakaku'                  => $kakaku,
	    'suryo'                   => $suryo,
	    'user_id'                 => $user_id
	];

    $result = $tb_hambai_konyusha_joho_meisai->insert($db, $param_meisai);

	if(!$result){
		error_log(print_r("�w���ҏ�񖾍דo�^�G���[", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
         $db->rollBack();
		 return false;
	}

	//�Z�b�V�����ɃJ�[�g���Z�b�g
    $_SESSION['konyu_id'] = $konyu_id;
    $_SESSION['gokei_kingaku'] = $gokei_kingaku;
    $_SESSION['soryo'] = $soryo;

$add_cart = [
	'hambai_id'               => $hambai_id, 
	'hambai_size_kbn'         => $hambai_size_kbn, 
	'hambai_color_kbn'        => $hambai_color_kbn, 
	'hambai_sentakushi_kbn'   => $hambai_sentakushi_kbn,
    'kakaku'                  => $kakaku,
    'suryo'                   => $suryo
];
//	$_SESSION['cart'] = array();
    $_SESSION['cart'] = $add_cart;

	error_log(print_r("***************�@ �J�[�g�@�o�^�@***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
	error_log(print_r($konyu_id, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');
	error_log(print_r($add_cart, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');


/************************************************************
* �J�[�g�������čw��ID���Ȃ��ꍇ�i��ʁ�����j�J�[�g�̓��e��DB�ɓo�^����
* �i���i�͉�����i�Ŏ擾���Ȃ����j
*************************************************************/
}elseif($konyu_id == ""){
	error_log(print_r("***************�@ �J�[�g�@�o�^�i��ʁ�����j�@***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');



/************************************************************
* �J�[�g�A�w��ID������ꍇ�i���������jDB�X�V����
* �i���i�͉�����i�Ŏ擾���Ȃ����j
*************************************************************/
}else{
	error_log(print_r("***************�@ �J�[�g�@�X�V�i���������j�@***********", true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/tanaka_cart_log.txt');



}


        $db->commit();





// �X�V���s�̏ꍇ
//if ($result == false) {
//    $db->rollBack();

//    // �߂�l��0�ݒ�
    $result = 0;
//} else {

    //���אV�K�o�^
//    $result = (new Tb_hambai_konyusha_joho_meisai())->insertKonyushaJohoMeisai($db, $param);
//    error_log(print_r($result, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/shibata_log.txt');
    // �X�V���s�̏ꍇ
//    if ($result == false) {
//        $db->rollBack();

        // �߂�l��0�ݒ�
//        $result = 0;
//    } else {
        // �X�V�����̏ꍇ
        // commit
//        $db->commit();

        // �߂�l��1�ݒ�
//        $result = 1;
//    }
//}



echo $result;

die();
