<?php
include_once '../ctrl/parts/beforeLoginHeader.php';

$includeView = '../views/confirmMember/confirmMember_tpl.php';

// SESSIONに積み込みがある場合
if (isset($_SESSION['tranScreen']) && ($_SESSION['tranScreen'] != "")) {
    $wk_kaiinType = (isset($_SESSION['kaiinType'])) ? $_SESSION['kaiinType'] : "";
    $wk_kaiinSbt = (isset($_SESSION['kaiinSbt'])) ? $_SESSION['kaiinSbt'] : "";
    $wk_kaihi = (isset($_SESSION['kaihi'])) ? $_SESSION['kaihi'] : "";
    $option = (isset($_SESSION['sel_option'])) ? $_SESSION['sel_option'] : "";
    $wk_sel_option = (isset($_SESSION['wk_sel_option'])) ? $_SESSION['wk_sel_option'] : "";
    $kaihi_eibun_option = (isset($_SESSION['kaihi_eibun_option'])) ? $_SESSION['kaihi_eibun_option'] : "";
    $file_front = (isset($_SESSION['file_front'])) ? $_SESSION['file_front'] : "";
    $file_back = (isset($_SESSION['file_back'])) ? $_SESSION['file_back'] : "";
    $filepath_front = (isset($_SESSION['filepath_front'])) ? $_SESSION['filepath_front'] : "";
    $filepath_back = (isset($_SESSION['filepath_back'])) ? $_SESSION['filepath_back'] : "";
    $riyu = (isset($_SESSION['sel_riyu'])) ? $_SESSION['sel_riyu'] : "";
    $wk_sel_riyu = (isset($_SESSION['wk_sel_riyu'])) ? $_SESSION['wk_sel_riyu'] : "";
    $riyu_sonota = (isset($_SESSION['sel_riyu_sonota'])) ? $_SESSION['sel_riyu_sonota'] : "";
    $nsca_hoji = (isset($_SESSION['sel_hoji'])) ? $_SESSION['sel_hoji'] : "";
    $wk_sel_hoji = (isset($_SESSION['wk_sel_hoji'])) ? $_SESSION['wk_sel_hoji'] : "";
    $name_sei = (isset($_SESSION['name_sei'])) ? $_SESSION['name_sei'] : "";
    $name_mei = (isset($_SESSION['name_mei'])) ? $_SESSION['name_mei'] : "";
    $name_sei_kana = (isset($_SESSION['name_sei_kana'])) ? $_SESSION['name_sei_kana'] : "";
    $name_mei_kana = (isset($_SESSION['name_mei_kana'])) ? $_SESSION['name_mei_kana'] : "";
    $name_last = (isset($_SESSION['name_last'])) ? $_SESSION['name_last'] : "";
    $name_first = (isset($_SESSION['name_first'])) ? $_SESSION['name_first'] : "";
    $year = (isset($_SESSION['year'])) ? $_SESSION['year'] : "";
    $month = (isset($_SESSION['month'])) ? $_SESSION['month'] : "";
    $day = (isset($_SESSION['day'])) ? $_SESSION['day'] : "";
    $gender = (isset($_SESSION['sel_gender'])) ? $_SESSION['sel_gender'] : "";
    $wk_sel_gender = (isset($_SESSION['wk_sel_gender'])) ? $_SESSION['wk_sel_gender'] : "";
    $yubin_nb_1 = (isset($_SESSION['yubin_nb_1'])) ? $_SESSION['yubin_nb_1'] : "";
    $yubin_nb_2 = (isset($_SESSION['yubin_nb_2'])) ? $_SESSION['yubin_nb_2'] : "";
    $sel_math = (isset($_SESSION['sel_math'])) ? $_SESSION['sel_math'] : "";
    $kenmei = (isset($_SESSION['kenmei'])) ? $_SESSION['kenmei'] : "";
    $address_shiku = (isset($_SESSION['address_shiku'])) ? $_SESSION['address_shiku'] : "";
    $address_tatemono = (isset($_SESSION['address_tatemono'])) ? $_SESSION['address_tatemono'] : "";
    $address_yomi_shiku = (isset($_SESSION['address_yomi_shiku'])) ? $_SESSION['address_yomi_shiku'] : "";
    $address_yomi_tatemono = (isset($_SESSION['address_yomi_tatemono'])) ? $_SESSION['address_yomi_tatemono'] : "";
    $nagareyama = (isset($_SESSION['sel_nagareyama'])) ? $_SESSION['sel_nagareyama'] : "";
    $wk_sel_nagareyama = (isset($_SESSION['wk_sel_nagareyama'])) ? $_SESSION['wk_sel_nagareyama'] : "";
    $tel = (isset($_SESSION['tel'])) ? $_SESSION['tel'] : "";
    $keitai_tel = (isset($_SESSION['keitai_tel'])) ? $_SESSION['keitai_tel'] : "";
    $fax = (isset($_SESSION['fax'])) ? $_SESSION['fax'] : "";
    $mail_address_1 = (isset($_SESSION['mail_address_1'])) ? $_SESSION['mail_address_1'] : "";
    $mail_address_2 = (isset($_SESSION['mail_address_2'])) ? $_SESSION['mail_address_2'] : "";
    $mail_login = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_mail_login = (!empty($_POST['wk_sel_mail_login'])) ? htmlentities($_POST['wk_sel_mail_login'], ENT_QUOTES, "UTF-8") : "";
    $mail = (isset($_SESSION['sel_mail'])) ? $_SESSION['sel_mail'] : "";
    $wk_sel_mail = (isset($_SESSION['wk_sel_mail'])) ? $_SESSION['wk_sel_mail'] : "";
    $merumaga = (isset($_SESSION['sel_merumaga'])) ? $_SESSION['sel_merumaga'] : "";
    $wk_sel_merumaga = (isset($_SESSION['wk_sel_merumaga'])) ? $_SESSION['wk_sel_merumaga'] : "";
    $pass_1 = (isset($_SESSION['pass_1'])) ? $_SESSION['pass_1'] : "";
    $url = (isset($_SESSION['url'])) ? $_SESSION['url'] : "";
    $shoku_1 = (isset($_SESSION['shoku_1'])) ? $_SESSION['shoku_1'] : "";
    $shoku_2 = (isset($_SESSION['shoku_2'])) ? $_SESSION['shoku_2'] : "";
    $shoku_3 = (isset($_SESSION['shoku_3'])) ? $_SESSION['shoku_3'] : "";
    $sel_shoku_1 = (isset($_SESSION['sel_shoku_1'])) ? $_SESSION['sel_shoku_1'] : "";
    $sel_shoku_2 = (isset($_SESSION['sel_shoku_2'])) ? $_SESSION['sel_shoku_2'] : "";
    $sel_shoku_3 = (isset($_SESSION['sel_shoku_3'])) ? $_SESSION['sel_shoku_3'] : "";
    $office_yubin_nb_1 = (isset($_SESSION['office_yubin_nb_1'])) ? $_SESSION['office_yubin_nb_1'] : "";
    $office_yubin_nb_2 = (isset($_SESSION['office_yubin_nb_2'])) ? $_SESSION['office_yubin_nb_2'] : "";
    $sel_office_math = (isset($_SESSION['sel_office_math'])) ? $_SESSION['sel_office_math'] : "";
    $office_kenmei = (isset($_SESSION['office_kenmei'])) ? $_SESSION['office_kenmei'] : "";
    $office_name = (isset($_SESSION['office_name'])) ? $_SESSION['office_name'] : "";
    $office_shiku = (isset($_SESSION['office_shiku'])) ? $_SESSION['office_shiku'] : "";
    $office_tatemono = (isset($_SESSION['office_tatemono'])) ? $_SESSION['office_tatemono'] : "";
    $office_fax = (isset($_SESSION['office_fax'])) ? $_SESSION['office_fax'] : "";
    $office_tel = (isset($_SESSION['office_tel'])) ? $_SESSION['office_tel'] : "";
    $shikaku = (isset($_SESSION['sel_shikaku'])) ? $_SESSION['sel_shikaku'] : "";
    $wk_sel_shikaku = (isset($_SESSION['wk_sel_shikaku'])) ? $_SESSION['wk_sel_shikaku'] : "";
    $shikaku_sonota = (isset($_SESSION['sel_shikaku_sonota'])) ? $_SESSION['sel_shikaku_sonota'] : "";
    $k_chiiki = (isset($_SESSION['sel_k_chiiki'])) ? $_SESSION['sel_k_chiiki'] : "";
    $wk_sel_k_chiiki = (isset($_SESSION['wk_sel_k_chiiki'])) ? $_SESSION['wk_sel_k_chiiki'] : "";
    $bunya = (isset($_SESSION['sel_bunya'])) ? $_SESSION['sel_bunya'] : "";
    $wk_sel_bunya = (isset($_SESSION['wk_sel_bunya'])) ? $_SESSION['wk_sel_bunya'] : "";
    $bunya_sonota = (isset($_SESSION['sel_bunya_sonota'])) ? $_SESSION['sel_bunya_sonota'] : "";
    $hoho = (isset($_SESSION['sel_hoho'])) ? $_SESSION['sel_hoho'] : "";
    $wk_sel_hoho = (isset($_SESSION['wk_sel_hoho'])) ? $_SESSION['wk_sel_hoho'] : "";
    $yubin = (isset($_SESSION['sel_yubin'])) ? $_SESSION['sel_yubin'] : "";
    $wk_sel_yubin = (isset($_SESSION['wk_sel_yubin'])) ? $_SESSION['wk_sel_yubin'] : "";
    $web = (isset($_SESSION['sel_web'])) ? $_SESSION['sel_web'] : "";
    $wk_sel_web = (isset($_SESSION['wk_sel_web'])) ? $_SESSION['wk_sel_web'] : "";
    $qa = (isset($_SESSION['sel_qa'])) ? $_SESSION['sel_qa'] : "";
    $wk_sel_qa = (isset($_SESSION['wk_sel_qa'])) ? $_SESSION['wk_sel_qa'] : "";
    $sel_chiiki = (isset($_SESSION['sel_chiiki'])) ? $_SESSION['sel_chiiki'] : "";
    $sel_office_chiiki = (isset($_SESSION['sel_office_chiiki'])) ? $_SESSION['sel_office_chiiki'] : "";

    unset($_SESSION['tranScreen']);
    error_log(print_r($_SESSION, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/sugai_log' . date("Ymd") . '.txt');


    // SESSIONに積み込みがない場合
} else {
    $wk_kaiinType = (!empty($_POST['kaiinType'])) ? htmlentities($_POST['kaiinType'], ENT_QUOTES, "UTF-8") : "";
    $wk_kaiinSbt = (!empty($_POST['kaiinSbt'])) ? htmlentities($_POST['kaiinSbt'], ENT_QUOTES, "UTF-8") : "";
    $wk_kaihi = (!empty($_POST['kaihi'])) ? htmlentities($_POST['kaihi'], ENT_QUOTES, "UTF-8") : "";
    $option = (!empty($_POST['sel_option'])) ? htmlentities($_POST['sel_option'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_option = (!empty($_POST['wk_sel_option'])) ? htmlentities($_POST['wk_sel_option'], ENT_QUOTES, "UTF-8") : "";
    $kaihi_eibun_option = (!empty($_POST['kaihi_eibun_option'])) ? htmlentities($_POST['kaihi_eibun_option'], ENT_QUOTES, "UTF-8") : "";
    $riyu = (!empty($_POST['sel_riyu'])) ? htmlentities($_POST['sel_riyu'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_riyu = (!empty($_POST['wk_sel_riyu'])) ? htmlentities($_POST['wk_sel_riyu'], ENT_QUOTES, "UTF-8") : "";
    $riyu_sonota = (!empty($_POST['sel_riyu_sonota'])) ? htmlentities($_POST['sel_riyu_sonota'], ENT_QUOTES, "UTF-8") : "";
    $nsca_hoji = (!empty($_POST['sel_hoji'])) ? htmlentities($_POST['sel_hoji'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_hoji = (!empty($_POST['wk_sel_hoji'])) ? htmlentities($_POST['wk_sel_hoji'], ENT_QUOTES, "UTF-8") : "";
    $file_front = (!empty($_POST['file_front'])) ? htmlentities($_POST['file_front'], ENT_QUOTES, "UTF-8") : "";
    $file_back = (!empty($_POST['file_back'])) ? htmlentities($_POST['file_back'], ENT_QUOTES, "UTF-8") : "";
    $filepath_front = (!empty($_POST['filepath_front'])) ? htmlentities($_POST['filepath_front'], ENT_QUOTES, "UTF-8") : "";
    $filepath_back = (!empty($_POST['filepath_back'])) ? htmlentities($_POST['filepath_back'], ENT_QUOTES, "UTF-8") : "";
    $name_sei = (!empty($_POST['name_sei'])) ? htmlentities($_POST['name_sei'], ENT_QUOTES, "UTF-8") : "";
    $name_mei = (!empty($_POST['name_mei'])) ? htmlentities($_POST['name_mei'], ENT_QUOTES, "UTF-8") : "";
    $name_sei_kana = (!empty($_POST['name_sei_kana'])) ? htmlentities($_POST['name_sei_kana'], ENT_QUOTES, "UTF-8") : "";
    $name_mei_kana = (!empty($_POST['name_mei_kana'])) ? htmlentities($_POST['name_mei_kana'], ENT_QUOTES, "UTF-8") : "";
    $name_last = (!empty($_POST['name_last'])) ? htmlentities($_POST['name_last'], ENT_QUOTES, "UTF-8") : "";
    $name_first = (!empty($_POST['name_first'])) ? htmlentities($_POST['name_first'], ENT_QUOTES, "UTF-8") : "";
    $year = (!empty($_POST['year'])) ? htmlentities($_POST['year'], ENT_QUOTES, "UTF-8") : "";
    $month = (!empty($_POST['month'])) ? htmlentities($_POST['month'], ENT_QUOTES, "UTF-8") : "";
    $day = (!empty($_POST['day'])) ? htmlentities($_POST['day'], ENT_QUOTES, "UTF-8") : "";
    $gender = (!empty($_POST['sel_gender'])) ? htmlentities($_POST['sel_gender'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_gender = (!empty($_POST['wk_sel_gender'])) ? htmlentities($_POST['wk_sel_gender'], ENT_QUOTES, "UTF-8") : "";
    $yubin_nb_1 = (!empty($_POST['yubin_nb_1'])) ? htmlentities($_POST['yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
    $yubin_nb_2 = (!empty($_POST['yubin_nb_2'])) ? htmlentities($_POST['yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
    $sel_math = (!empty($_POST['sel_math'])) ? htmlentities($_POST['sel_math'], ENT_QUOTES, "UTF-8") : "";
    $kenmei = (!empty($_POST['kenmei'])) ? htmlentities($_POST['kenmei'], ENT_QUOTES, "UTF-8") : "";
    $address_shiku = (!empty($_POST['address_shiku'])) ? htmlentities($_POST['address_shiku'], ENT_QUOTES, "UTF-8") : "";
    $address_tatemono = (!empty($_POST['address_tatemono'])) ? htmlentities($_POST['address_tatemono'], ENT_QUOTES, "UTF-8") : "";
    $address_yomi_shiku = (!empty($_POST['address_yomi_shiku'])) ? htmlentities($_POST['address_yomi_shiku'], ENT_QUOTES, "UTF-8") : "";
    $address_yomi_tatemono = (!empty($_POST['address_yomi_tatemono'])) ? htmlentities($_POST['address_yomi_tatemono'], ENT_QUOTES, "UTF-8") : "";
    $nagareyama = (!empty($_POST['sel_nagareyama'])) ? htmlentities($_POST['sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_nagareyama = (!empty($_POST['wk_sel_nagareyama'])) ? htmlentities($_POST['wk_sel_nagareyama'], ENT_QUOTES, "UTF-8") : "";
    $tel = (!empty($_POST['tel'])) ? htmlentities($_POST['tel'], ENT_QUOTES, "UTF-8") : "";
    $keitai_tel = (!empty($_POST['keitai_tel'])) ? htmlentities($_POST['keitai_tel'], ENT_QUOTES, "UTF-8") : "";
    $fax = (!empty($_POST['fax'])) ? htmlentities($_POST['fax'], ENT_QUOTES, "UTF-8") : "";
    $mail_address_1 = (!empty($_POST['mail_address_1'])) ? htmlentities($_POST['mail_address_1'], ENT_QUOTES, "UTF-8") : "";
    $mail_address_2 = (!empty($_POST['mail_address_2'])) ? htmlentities($_POST['mail_address_2'], ENT_QUOTES, "UTF-8") : "";
    $mail_login = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_mail_login = (!empty($_POST['wk_sel_mail_login'])) ? htmlentities($_POST['wk_sel_mail_login'], ENT_QUOTES, "UTF-8") : "";
    $mail = (!empty($_POST['sel_mail'])) ? htmlentities($_POST['sel_mail'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_mail = (!empty($_POST['wk_sel_mail'])) ? htmlentities($_POST['wk_sel_mail'], ENT_QUOTES, "UTF-8") : "";
    $merumaga = (!empty($_POST['sel_merumaga'])) ? htmlentities($_POST['sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_merumaga = (!empty($_POST['wk_sel_merumaga'])) ? htmlentities($_POST['wk_sel_merumaga'], ENT_QUOTES, "UTF-8") : "";
    $pass_1 = (!empty($_POST['pass_1'])) ? htmlentities($_POST['pass_1'], ENT_QUOTES, "UTF-8") : "";
    $url = (!empty($_POST['url'])) ? htmlentities($_POST['url'], ENT_QUOTES, "UTF-8") : "";
    $shoku_1 = (!empty($_POST['shoku_1'])) ? htmlentities($_POST['shoku_1'], ENT_QUOTES, "UTF-8") : "";
    $shoku_2 = (!empty($_POST['shoku_2'])) ? htmlentities($_POST['shoku_2'], ENT_QUOTES, "UTF-8") : "";
    $shoku_3 = (!empty($_POST['shoku_3'])) ? htmlentities($_POST['shoku_3'], ENT_QUOTES, "UTF-8") : "";
    $sel_shoku_1 = (!empty($_POST['sel_shoku_1'])) ? htmlentities($_POST['sel_shoku_1'], ENT_QUOTES, "UTF-8") : "";
    $sel_shoku_2 = (!empty($_POST['sel_shoku_2'])) ? htmlentities($_POST['sel_shoku_2'], ENT_QUOTES, "UTF-8") : "";
    $sel_shoku_3 = (!empty($_POST['sel_shoku_3'])) ? htmlentities($_POST['sel_shoku_3'], ENT_QUOTES, "UTF-8") : "";
    $office_yubin_nb_1 = (!empty($_POST['office_yubin_nb_1'])) ? htmlentities($_POST['office_yubin_nb_1'], ENT_QUOTES, "UTF-8") : "";
    $office_yubin_nb_2 = (!empty($_POST['office_yubin_nb_2'])) ? htmlentities($_POST['office_yubin_nb_2'], ENT_QUOTES, "UTF-8") : "";
    $sel_office_math = (!empty($_POST['sel_office_math'])) ? htmlentities($_POST['sel_office_math'], ENT_QUOTES, "UTF-8") : "";
    $office_kenmei = (!empty($_POST['office_kenmei'])) ? htmlentities($_POST['office_kenmei'], ENT_QUOTES, "UTF-8") : "";
    $office_name = (!empty($_POST['office_name'])) ? htmlentities($_POST['office_name'], ENT_QUOTES, "UTF-8") : "";
    $office_shiku = (!empty($_POST['office_shiku'])) ? htmlentities($_POST['office_shiku'], ENT_QUOTES, "UTF-8") : "";
    $office_tatemono = (!empty($_POST['office_tatemono'])) ? htmlentities($_POST['office_tatemono'], ENT_QUOTES, "UTF-8") : "";
    $office_fax = (!empty($_POST['office_fax'])) ? htmlentities($_POST['office_fax'], ENT_QUOTES, "UTF-8") : "";
    $office_tel = (!empty($_POST['office_tel'])) ? htmlentities($_POST['office_tel'], ENT_QUOTES, "UTF-8") : "";
    $shikaku = (!empty($_POST['sel_shikaku'])) ? htmlentities($_POST['sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_shikaku = (!empty($_POST['wk_sel_shikaku'])) ? htmlentities($_POST['wk_sel_shikaku'], ENT_QUOTES, "UTF-8") : "";
    $shikaku_sonota = (!empty($_POST['sel_shikaku_sonota'])) ? htmlentities($_POST['sel_shikaku_sonota'], ENT_QUOTES, "UTF-8") : "";
    $k_chiiki = (!empty($_POST['sel_k_chiiki'])) ? htmlentities($_POST['sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_k_chiiki = (!empty($_POST['wk_sel_k_chiiki'])) ? htmlentities($_POST['wk_sel_k_chiiki'], ENT_QUOTES, "UTF-8") : "";
    $bunya = (!empty($_POST['sel_bunya'])) ? htmlentities($_POST['sel_bunya'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_bunya = (!empty($_POST['wk_sel_bunya'])) ? htmlentities($_POST['wk_sel_bunya'], ENT_QUOTES, "UTF-8") : "";
    $bunya_sonota = (!empty($_POST['sel_bunya_sonota'])) ? htmlentities($_POST['sel_bunya_sonota'], ENT_QUOTES, "UTF-8") : "";
    $hoho = (!empty($_POST['sel_hoho'])) ? htmlentities($_POST['sel_hoho'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_hoho = (!empty($_POST['wk_sel_hoho'])) ? htmlentities($_POST['wk_sel_hoho'], ENT_QUOTES, "UTF-8") : "";
    $yubin = (!empty($_POST['sel_yubin'])) ? htmlentities($_POST['sel_yubin'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_yubin = (!empty($_POST['wk_sel_yubin'])) ? htmlentities($_POST['wk_sel_yubin'], ENT_QUOTES, "UTF-8") : "";
    $web = (!empty($_POST['sel_web'])) ? htmlentities($_POST['sel_web'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_web = (!empty($_POST['wk_sel_web'])) ? htmlentities($_POST['wk_sel_web'], ENT_QUOTES, "UTF-8") : "";
    $qa = (!empty($_POST['sel_qa'])) ? htmlentities($_POST['sel_qa'], ENT_QUOTES, "UTF-8") : "";
    $wk_sel_qa = (!empty($_POST['wk_sel_qa'])) ? htmlentities($_POST['wk_sel_qa'], ENT_QUOTES, "UTF-8") : "";
    $sel_chiiki = (!empty($_POST['sel_chiiki'])) ? htmlentities($_POST['sel_chiiki'], ENT_QUOTES, "UTF-8") : "";
    $sel_office_chiiki = (!empty($_POST['sel_office_chiiki'])) ? htmlentities($_POST['sel_office_chiiki'], ENT_QUOTES, "UTF-8") : "";
}
//学生会員のみファイルアップロード処理を行う。
if ($wk_kaiinSbt == 2) {
    if ($file_front || $file_back) {
        //確認画面から入力画面に戻って再び確認画面に遷移した場合
        
        //アップロードするファイルを変更した場合
        if ($file_front != $_FILES['file_front']['name']) {
            //フォルダ名作成
            $directory_path = "../upload/" . date('Ymd_His');

            //フォルダ作成
            mkdir($directory_path, 0777);

            $filePath_front = $directory_path . "/" . basename($_FILES['file_front']['name']);

            move_uploaded_file($_FILES['file_front']['tmp_name'], $filePath_front);

        } else {
            $filePath_front = $directory_path . "/" . basename($_FILES['file_front']['name']);
        }

        if ($file_back != $_FILES['file_back']['name']) {
            //フォルダ名作成
            $directory_path = "../upload/" . date('Ymd_His');

            //フォルダ作成
            mkdir($directory_path, 0777);

            $filePath_back = $directory_path . "/" . basename($_FILES['file_back']['name']);

            move_uploaded_file($_FILES['file_back']['tmp_name'], $filePath_back);

        }

    } else {
        //フォルダ名作成
        $directory_path = "../upload/" . date('Ymd_His');

        //フォルダ作成
        mkdir($directory_path, 0777);

        $filePath_front = $directory_path . "/" . basename($_FILES['file_front']['name']);

        move_uploaded_file($_FILES['file_front']['tmp_name'], $filePath_front);

        if (basename($_FILES['file_back']['name'])) {
            $filePath_back = $directory_path . "/" . basename($_FILES['file_back']['name']);

            move_uploaded_file($_FILES['file_back']['tmp_name'], $filePath_back);
        } else {
            $filePath_back = "";
        }
    }
}


include_once $includeView;
