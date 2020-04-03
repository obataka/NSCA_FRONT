<?php
namespace Was;

session_start();

require './Config/Config.php';
require './Config/FregiConfig.php';
require './paymentSelect_constants.php';
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

/*************************************************************************************************************************************
* PaymentSelect内で使用する汎用的な関数を定義するクラス
*************************************************************************************************************************************/
Class paymentSelect_functions {
    
    /*****************************************************************************
    * F-Regi決済用の連番を取得する
    *
    * @param  : db DBオブジェクト
    * @return : 成功 決済連番 / 失敗 null
    ******************************************************************************/
    public static function getFregiId($db) {

        // テーブルオブジェクト初期化
        $cm_control = new Cm_control();
        $result = null;

        // 決済連番をカウントアップする 
        if ($cm_control->countUpKessaiRemban_noTran($db)) {
            // 決済連番を取得
            $result = $cm_control->getKessaiRemban();
        }

        if (empty($result)) {
            return null;
        } else {
            return $result['kessai_remban'];
        }
    }

    /*****************************************************************************
    * すでに認定校生データが存在するかを確認し、存在した場合に会員番号を返す
    *
    * @param  : kaiinParam 会員データ
    * @return : 会員番号
    ******************************************************************************/
    public static function getKaiinNoForMemberCertificate($kaiinParam) {

        // テーブルオブジェクト初期化
        $tb_kaiin_joho = new Tb_kaiin_joho();
        $kaiin_joho = $tb_kaiin_joho->findNinteiKousei($kaiinParam);

        if(empty($kaiin_joho)) {
            return null;
        } else {
            return $kaiin_joho['kaiin_no'];
        }
    }

    /*****************************************************************************
    * 会員データの登録を行う。登録後、登録データの会員番号を返却する
    *
    * @param  : db DBオブジェクト
    * @param  : oldKaiinNo 旧会員番号
    * @param  : payType 支払方法タイプ
    * @param  : certificateFlg 認定校フラグ
    * @return : 成功 新たに採番した会員番号 / 失敗 null
    ******************************************************************************/
    public static function insertMemberData($db, $oldKaiinNo, $payType, $certificateFlg) {

        // テーブルオブジェクト初期化
        $tb_kaiin_joho = new Tb_kaiin_joho();
        $tb_kaiin_jotai = new Tb_kaiin_jotai();
        $tb_kaiin_journal = new Tb_kaiin_journal();
        $tb_kaiin_sonota = new Tb_kaiin_sonota();
        $tb_kaiin_pick_up = new Tb_kaiin_pick_up();
        $tb_kaiin_nintei = new Tb_kaiin_nintei();
        $tb_kaiin_ceu = new Tb_kaiin_ceu();

        // パラメータの準備
        $param = array();
        $param['kyukaiin_no'] = $oldKaiinNo;
        $param['kaiin_sbt_kbn'] = isset($_SESSION['kaiin_sbt_kbn']) ? $_SESSION['kaiin_sbt_kbn'] : '';
        $param['shimei_sei'] = isset($_SESSION['shimei_sei']) ? $_SESSION['shimei_sei'] : '';
        $param['shimei_mei'] = isset($_SESSION['shimei_mei']) ? $_SESSION['shimei_mei'] : '';
        $param['furigana_sei'] = isset($_SESSION['furigana_sei']) ? $_SESSION['furigana_sei'] : '';
        $param['furigana_mei'] = isset($_SESSION['furigana_mei']) ? $_SESSION['furigana_mei'] : '';
        $param['seinengappi'] = isset($_SESSION['seinengappi']) ? $_SESSION['seinengappi'] : '';
        $param['seibetsu_kbn'] = isset($_SESSION['seibetsu_kbn']) ? $_SESSION['seibetsu_kbn'] : '';
        $param['yubin_no'] = isset($_SESSION['yubin_no']) ? $_SESSION['yubin_no'] : '';
        $param['ken_no'] = isset($_SESSION['ken_no']) ? $_SESSION['ken_no'] : '';
        $param['jusho_1'] = isset($_SESSION['jusho_1']) ? $_SESSION['jusho_1'] : '';
        $param['jusho_2'] = isset($_SESSION['jusho_2']) ? $_SESSION['jusho_2'] : '';
        $param['kana_jusho_1'] = isset($_SESSION['kana_jusho_1']) ? $_SESSION['kana_jusho_1'] : '';
        $param['kana_jusho_2'] = isset($_SESSION['kana_jusho_2']) ? $_SESSION['kana_jusho_2'] : '';
        $param['tel'] = isset($_SESSION['tel']) ? $_SESSION['tel'] : '';
        $param['fax'] = isset($_SESSION['fax']) ? $_SESSION['fax'] : '';
        $param['keitai_no'] = isset($_SESSION['keitai_no']) ? $_SESSION['keitai_no'] : '';
        $param['keitai_denwa_shurui'] = isset($_SESSION['keitai_denwa_shurui']) ? $_SESSION['keitai_denwa_shurui'] : '';
        $param['keitai_denwa_shurui'] = isset($_SESSION['keitai_denwa_shurui']) ? $_SESSION['keitai_denwa_shurui'] : '';
        $param['email_1'] = isset($_SESSION['email_1']) ? $_SESSION['email_1'] : '';
        $param['email_2'] = isset($_SESSION['email_2']) ? $_SESSION['email_2'] : '';
        $param['url_1'] = isset($_SESSION['url_1']) ? $_SESSION['url_1'] : '';
        $param['url_2'] = isset($_SESSION['url_2']) ? $_SESSION['url_2'] : '';
        $param['shokugyo_kbn_1'] = isset($_SESSION['shokugyo_kbn_1']) ? $_SESSION['shokugyo_kbn_1'] : '';
        $param['shokugyo_kbn_2'] = isset($_SESSION['shokugyo_kbn_2']) ? $_SESSION['shokugyo_kbn_2'] : '';
        $param['shokugyo_kbn_3'] = isset($_SESSION['shokugyo_kbn_3']) ? $_SESSION['shokugyo_kbn_3'] : '';
        $param['kimmusakimei'] = isset($_SESSION['kimmusakimei']) ? $_SESSION['kimmusakimei'] : '';
        $param['kimmusaki_yubin_no'] = isset($_SESSION['kimmusaki_yubin_no']) ? $_SESSION['kimmusaki_yubin_no'] : '';
        $param['kimmusaki_ken_no'] = isset($_SESSION['kimmusaki_ken_no']) ? $_SESSION['kimmusaki_ken_no'] : '';
        $param['kimmusaki_jusho_1'] = isset($_SESSION['kimmusaki_jusho_1']) ? $_SESSION['kimmusaki_jusho_1'] : '';
        $param['kimmusaki_jusho_2'] = isset($_SESSION['kimmusaki_jusho_2']) ? $_SESSION['kimmusaki_jusho_2'] : '';
        $param['kimmusaki_tel'] = isset($_SESSION['kimmusaki_tel']) ? $_SESSION['kimmusaki_tel'] : '';
        $param['kimmusaki_fax'] = isset($_SESSION['kimmusaki_fax']) ? $_SESSION['kimmusaki_fax'] : '';
        $param['first'] = isset($_SESSION['first']) ? $_SESSION['first'] : '';
        $param['last'] = isset($_SESSION['last']) ? $_SESSION['last'] : '';
        $param['gakuseisho_filemei'] = isset($_SESSION['gakuseisho_filemei']) ? $_SESSION['gakuseisho_filemei'] : '';
        $param['gakuseisho_filemei_2'] = isset($_SESSION['gakuseisho_filemei_2']) ? $_SESSION['gakuseisho_filemei_2'] : '';
        $param['kimmusaki_ken_no'] = isset($_SESSION['kimmusaki_ken_no']) ? $_SESSION['kimmusaki_ken_no'] : '';
        $param['nyukai_riyu_kbn'] = isset($_SESSION['nyukai_riyu_kbn']) ? $_SESSION['nyukai_riyu_kbn'] : '';
        $param['nyukai_riyu_biko'] = isset($_SESSION['nyukai_riyu_biko']) ? $_SESSION['nyukai_riyu_biko'] : '';
        $param['eibun_option_kbn'] = isset($_SESSION['eibun_option_kbn']) ? $_SESSION['eibun_option_kbn'] : '';
        $param['kaihi_shiharai_hoho_kbn'] = $payType;
        // テーブル共通項目
        $param['sakujo_flg'] = 0;
        $param['sakusei_user_id'] = $param['koshin_user_id'] = paymentSelect_constants::USER_ID;
        $param['sakusei_nichiji'] = $param['koshin_nichiji'] = date('Y/m/d H:i:s');

        if(isset($_SESSION['renraku_hoho']) && $_SESSION['renraku_hoho'] == '1') {
            // 連絡方法：郵送
            $param['renraku_hoho_yuso'] = 1;
            $param['renraku_hoho_denshi_email'] = 0;
        } else {
            // 連絡方法：Eメール
            $param['renraku_hoho_yuso'] = 0;
            $param['renraku_hoho_denshi_email'] = 1;
        }

        if(isset($_SESSION['merumaga']) && $_SESSION['merumaga'] == '1') {
            // メルマガ配信希望あり
            if(isset($_SESSION['mail']) && $_SESSION['mail'] == '1') {
                // メール1で受信
                $param['email_1_merumaga_haishin'] = 1;
                $param['email_2_merumaga_haishin'] = 0;
            } else {
                // メール2で受信
                $param['email_1_merumaga_haishin'] = 0;
                $param['email_2_merumaga_haishin'] = 1;
            }
        }

        if(isset($_SESSION['daisansha_questionnaire_kbn']) && $_SESSION['daisansha_questionnaire_kbn'] == '1') {
            // アンケートに協力する
            $param['daisansha_questionnaire_kbn'] = 1;
        } else {
            $param['daisansha_questionnaire_kbn'] = 0;
        }

        if(isset($_SESSION['website_keisai_kbn']) && $_SESSION['website_keisai_kbn'] == '1') {
            // ウェブサイトに掲載する
            $param['website_keisai_kbn'] = 1;
        } else {
            $param['website_keisai_kbn'] = 0;
        }

        if(isset($_SESSION['nsca_hoji']) && $_SESSION['nsca_hoji'] == '1') {
            // NSCA過去資格保持区分
            $param['kako_shikaku_umu_kbn'] = 1;
        } else {
            $param['kako_shikaku_umu_kbn'] = 0;
        }

        $toroku_jokyo = 0; // 登録状況区分：仮登録
        $kaiin_jokyo = 1; // 会員状況区分：入金待ち
        $country = 'JAPAN'; // 国：日本
        $web_nyukai = 1; // Web入会区分：Web
        $gakuseisho_kakunin = 0; // 学生証確認区分：未確認
        $journal_hasso = 0; // ジャーナル発送区分：なし
        $journal_hasso_cnt = 0; // ジャーナル発送数
        $usa_website_id	= 0; // 米国WebサイトID区分
        $kaigai_hasso_id_tsuchi = 0; // 海外発送ID通知区分：通知なし
        $card_toroku = 0; // カード登録：なし
        $shiken_sbt_cscs = 1; // 試験種別区分：CSCS
        $shiken_sbt_cpt = 2; // 試験種別区分：CPT

        // 1) 会員番号を取得
        $kaiin_no = getNewKaiinNo($param['kaiin_sbt_kbn']);
        if(empty($kaiin_no)) return null;

        // 認定校生の場合、備考を引き継ぐ
        if($certificateFlg == 1) {
            $old_kaiin_joho = $tb_kaiin_joho->findNinteiKousei($param);
            if(!empty($old_kaiin_joho)) $param['biko'] = $old_kaiin_joho['biko'];
        }

        // 2) tb_kaiin_joho の登録
        $param['toroku_jokyo_kbn'] = $toroku_jokyo;
        $param['kaiin_jokyo_kbn'] = $kaiin_jokyo;
        $param['country'] = $country;
        $param['web_nyukai_kbn'] = $web_nyukai;
        if(!$tb_kaiin_joho->insertRec_noTran($db, $param)) {
            return null;
        }

        // 3) tb_kaiin_jotai の登録
        $param['gakuseisho_kakunin_kbn'] = $gakuseisho_kakunin;
        if(!$tb_kaiin_jotai->insertRec_noTran($db, $param)) {
            return null;
        }

        // 4) tb_kaiin_journal の登録
        $param['journal_hasso_kbn'] = $journal_hasso;
        $param['journal_hassosu'] = $journal_hasso_cnt;
        $param['beikoku_website_id_kbn'] = $usa_website_id;
        $param['kaigai_hasso_id_tsuchi_kbn'] = $kaigai_hasso_id_tsuchi;
        if(!$tb_kaiin_journal->insertRec_noTran($db, $param)) {
            return null;
        }

        // 5) tb_kaiin_sonota の登録
        $param['card_toroku'] = $card_toroku;
        if(!$tb_kaiin_sonota->insertRec_noTran($db, $param)) {
            return null;
        }

        // 6) tb_kaiin_pick_up の登録
        if(!$tb_kaiin_pick_up->insertRec_noTran($db, $param)) {
            return null;
        }

        // 認定校生以外の場合に新規登録
        if($certificateFlg == 0) {
            // 7) tb_kaiin_nintei の登録
            if(!$tb_kaiin_nintei->insertRec_noTran($db, $param)) {
                return null;
            }
    
            // 8-1) tb_kaiin_ceu(CSCS)
            $param['shiken_sbt_kbn'] = $shiken_sbt_cscs;
            if(!$tb_kaiin_ceu->insertRec_noTran($db, $param)) {
                return null;
            }

            // 8-2) tb_kaiin_ceu(CPT)
            $param['shiken_sbt_kbn'] = $shiken_sbt_cpt;
            if(!$tb_kaiin_ceu->insertRec_noTran($db, $param)) {
                return null;
            }
        }

        // 9) tb_kaiin_sentaku は、別で登録
        // 10) 会員番号をセッションに保存
        return $kaiin_no;
    }

    /*****************************************************************************
    * 会員種別によって採番後の新しい会員番号を返却する
    *
    * @param  : kaiin_sbt_kbn 会員種別
    * @return : 成功 新たに採番した会員番号 / 失敗 null
    ******************************************************************************/
    private static function getNewKaiinNo($kaiin_sbt_kbn) {

        // テーブルオブジェクト初期化
        $tb_kaiin_joho = new Tb_kaiin_joho();

        $seikaiin = 1; // 正会員
        $gakusei = 2; // 学生会員
        $eibun = 3; // 英文会員
        $beikoku = 11; // 米国会員
        $ippan = 12; // 一般
        $nintei = 13; // 認定校生
        $yakuin = 14; // 役員
        $gaibu = 15; // 外部講師
        $sonota = 16; // その他
        $sanjoKigyo = 4; // 賛助企業
        $sanjoGakko = 5; // 賛助学校
        $ninteiko = 6; // 認定校
        $nenkan = 7; // 年間協賛
        $tanpatsu = 8; // 単発協賛
        $toshokan = 9; // 図書館
        $provider = 10; // プロバイダー

        if($kaiin_sbt_kbn == $seikaiin
            || $kaiin_sbt_kbn == $gakusei
            || $kaiin_sbt_kbn == $eibun
        ) {
            // 正会員、学生会員、英文会員 (8番台)
            $today = date('ymd');
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByBetween(
                '8' .$today .'01', 
                '8' .$today .'99'
            );
            
            if(empty($kaiin_joho)) {
                return '8' .$today .'01';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }

        } else if($kaiin_sbt_kbn == $ippan
            || $kaiin_sbt_kbn == $nenkan
            || $kaiin_sbt_kbn == $tanpatsu
            || $kaiin_sbt_kbn == $provider
        ) {
            // 一般、年間協賛、単発協賛 (7番台)
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByLike('70%');
            
            if(empty($kaiin_joho)) {
                return '700000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }

        } else if($kaiin_sbt_kbn == $yakuin
            || $kaiin_sbt_kbn == $gaibu
            || $kaiin_sbt_kbn == $sonota
            || $kaiin_sbt_kbn == $toshokan
        ) {
            // 役員、外部講師、その他、図書館 (5番台)
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByLike('50%');
            
            if(empty($kaiin_joho)) {
                return '500000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }
        
        } else if($kaiin_sbt_kbn == $nintei) {
            // 認定校生 (4番台)
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByLike('4%');
            
            if(empty($kaiin_joho)) {
                return '400000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }
        
        } else if($kaiin_sbt_kbn == $sanjoKigyo
            || $kaiin_sbt_kbn == $sanjoGakko
            || $kaiin_sbt_kbn == $ninteiko
        ) {
            // 賛助企業、賛助学校、認定校 (3番台)
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByLike('3%');
            
            if(empty($kaiin_joho)) {
                return '300000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }

        } else if($kaiin_sbt_kbn == $beikoku) {
            // 米国会員(USA)
            $kaiin_joho = $tb_kaiin_joho->getMaxKaiinNoByLike('USA%');
            
            if(empty($kaiin_joho)) {
                return 'USA000001';
            } else {
                $intKaiinNo = intval(subStr($kaiin_joho['kaiin_no'], -6));
                return 'USA' .sprintf('%06d', strval($intKaiinNo + 1));
            }
        }
        return null;
    }

    /*****************************************************************************
    * 会員に紐付く各明細テーブルを更新する
    * 認定校生が会員になった場合、会員番号を8番台に変更
    *
    * TB会員情報、TB会員状態、TB会員ジャーナル、TB会員その他、
    * TB会員ピックアップ、TB会員選択　は新規作成する為、削除フラグを更新する
    *
    * @param  : db DBオブジェクト
    * @param  : oldKaiinNo 旧会員番号
    * @return : 成功 true / 失敗 false
    ******************************************************************************/
    public static function updateMemberCertificate($db, $oldKaiinNo) {

        // テーブルオブジェクト初期化
        $tb_kaiin_joho = new Tb_kaiin_joho();
        $tb_kaiin_jotai = new Tb_kaiin_jotai();
        $tb_kaiin_journal = new Tb_kaiin_journal();
        $tb_kaiin_sonota = new Tb_kaiin_sonota();
        $tb_kaiin_pick_up = new Tb_kaiin_pick_up();
        $tb_kaiin_nintei = new Tb_kaiin_nintei();
        $tb_kaiin_yakushoku = new Tb_kaiin_yakushoku();
        $tb_kaiin_ceu = new Tb_kaiin_ceu();
        $tb_kaiin_sentaku = new Tb_kaiin_sentaku();
        $tb_keiri_joho = new Tb_keiri_joho();
        $tb_kessai_hakko = new Tb_kessai_hakko();
        $tb_shiken = new Tb_shiken();
        $tb_shiken_meisai = new Tb_shiken_meisai();
        $tb_doga_konyusha_meisai = new Tb_doga_konyusha_meisai();
        $tb_ceu_conference_joho_meisai = new Tb_ceu_conference_joho_meisai();
        $tb_ceu_conference_koen_sankasha = new Tb_ceu_conference_koen_sankasha();
        $tb_ceu_quiz_joho_meisai = new Tb_ceu_quiz_joho_meisai();
        $tb_ceu_joho_meisai = new Tb_ceu_joho_meisai();
        $tb_kako_shiken_joho_meisai = new Tb_kako_shiken_joho_meisai();
        $tb_kataho_gokaku = new Tb_kataho_gokaku();
        $tb_nintei_meisai = new Tb_nintei_meisai();
        
        // パラメータの準備
        $param = array();
        $param['kaiin_no'] = isset($_SESSION['kaiinNo']) ? $_SESSION['kaiinNo'] : ''; // 会員番号
        $param['sakujo_flg'] = 1; // 削除フラグ
        $param['koshin_user_id'] = payment_constants::USER_ID; // ユーザーID
        if(empty($param['kaiin_no'])) return false;

        // 1) 旧認定校生データを削除
        if(!$tb_kaiin_joho->updateSakujoFlg_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_jotai->updateSakujoFlg_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_journal->updateSakujoFlg_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_sonota->updateSakujoFlg_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_pick_up->updateSakujoFlg_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_sentaku->updateSakujoFlgByKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 2) 認定情報データを最新の会員番号に更新
        if(!$tb_kaiin_nintei->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_yakushoku->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kaiin_ceu->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 3) 経理情報データを最新の会員番号に更新
        if(!$tb_keiri_joho->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }
        if(!$tb_kessai_hakko->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 4) 試験情報データを最新の会員番号に更新
        if(!$tb_shiken->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }
        if(!$tb_shiken_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 5) 動画情報データを最新の会員番号に更新
        if(!$tb_doga_konyusha_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 6) カンファレンス情報データを最新の会員番号に更新
        if(!$tb_ceu_conference_joho_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }
        if(!$tb_ceu_conference_koen_sankasha->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 7) クイズ情報データを最新の会員番号に更新
        if(!$tb_ceu_quiz_joho_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 8) CEU情報データを最新の会員番号に更新
        // ※検定員・総会・トレ検・レベル1情報データは下記テーブルに統合されたため、同時に更新
        if(!$tb_ceu_joho_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 9) 過去試験情報データを最新の会員番号に更新
        if(!$tb_kako_shiken_joho_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 10)片方合格データを最新の会員番号に更新
        if(!$tb_kataho_gokaku->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        // 11)認定明細データを最新の会員番号に更新
        if(!$tb_nintei_meisai->updateKaiinNoByOldKaiinNo_noTran($db, $param)) {
            return false;
        }

        return true;
    }

    /*****************************************************************************
    * 会員選択データの登録を行う
    * 古い会員選択データはすべて物理削除し、画面で選択されたデータをすべて登録します。
    * 
    * @param  : db DBオブジェクト
    * @return : 成功 true / 失敗 false
    ******************************************************************************/
    public static function insertMemberSelectData($db) {

        // テーブルオブジェクト初期化
        $tb_kaiin_sentaku = new Tb_kaiin_sentaku();

        // パラメータの準備
        $param = array();
        $param['kaiin_no'] = isset($_SESSION['kaiinNo']) ? $_SESSION['kaiinNo'] : '';
        $param['sakujo_flg'] = 0;
        $param['sakusei_user_id'] = $param['koshin_user_id'] = payment_constants::USER_ID;
        $param['sakusei_nichiji'] = $param['koshin_nichiji'] = date('Y/m/d H:i:s');

        // 会員選択データの削除
        if(!$tb_kaiin_sentaku->deleteRec_noToran($db, $param)) {
            return false;
        }
        
        // NSCA以外の認定資格の登録
        $shikaku = isset($_SESSION['wk_sel_shikaku']) ? $_SESSION['wk_sel_shikaku'] : '';
        $arrayShikaku = !empty($shikaku) ? explode(',',$shikaku) : null;
        $shikakuSonota = isset($_SESSION['sel_shikaku_sonota']) ? $_SESSION['sel_shikaku_sonota'] : null;
        if(!empty($arrayShikaku)) {
            if(!insertKaiinSentakuByArray($db, $tb_kaiin_sentaku, $param, 22, $arrayShikaku, $shikakuSonota)) {
                return false;
            }
        }

        // 興味のある地域の登録
        $chiiki = isset($_SESSION['wk_sel_k_chiiki']) ? $_SESSION['wk_sel_k_chiiki'] : '';
        $arrayChiiki = !empty($chiiki) ? explode(',',$chiiki) : null;
        if(!empty($arrayChiiki)) {
            if(!insertKaiinSentakuByArray($db, $tb_kaiin_sentaku, $param, 32, $arrayChiiki, null)) {
                return false;
            }
        }

        // 興味のある分野の登録
        $bunya = isset($_SESSION['wk_sel_bunya']) ? $_SESSION['wk_sel_bunya'] : '';
        $arrayBunya = !empty($bunya) ? explode(',',$bunya) : null;
        $bunyaSonota = isset($_SESSION['sel_bunya_sonota']) ? $_SESSION['sel_bunya_sonota'] : null;
        if(!empty($arrayBunya)) {
            if(!insertKaiinSentakuByArray($db, $tb_kaiin_sentaku, $param, 24, $arrayBunya, $bunyaSonota)) {
                return false;
            }
        }

        return true;
    }

    /*****************************************************************************
    * 配列データから会員選択テーブルへの登録を行う
    * 引数で名称区分を設定します
    * 途中でエラーが発生した場合、falseを返します
    *
    * @return : 成功 true / 失敗 false
    ******************************************************************************/
    private static function insertKaiinSentakuByArray($db, $tb_kaiin_sentaku, $param, $meishoKbn, $arrayMeishoCd, $biko) {

        $param['meisho_kbn'] = $meishoKbn;
        foreach($arrayMeishoCd as $meishoCd) {
            if(!empty($meishoCd)) {
                $param['meisho_cd'] = $meishoCd;
                $param['biko'] = ($meishoCd == 99) ? $biko : null;
                if(!$tb_kaiin_sentaku->insertRec_noToran($db, $param)) return false;
            }
        }
        return true;
    }

    /*****************************************************************************
    * 経理データ用伝票番号を取得する
    *
    * @param  : db DBオブジェクト
    * @return : 成功 新たに採番した経理番号 / 失敗 null
    ******************************************************************************/
    private static function getAccountingId($db) {

        // テーブルオブジェクトの初期化
        $cm_control = new Cm_control();
        $result = null;

        // 経理伝票番号をカウントアップする 
        if ($cm_control->countUpKeiriDempyoNo_noTran($db)) {
            // 経理伝票番号を取得
            $result = $cm_control->findById(1);
        }

        if (empty($result)) {
            return null;
        } else {
            return $result['keiri_dempyo_no'];
        }
    }

    /*****************************************************************************
    * 経理情報テーブルに新規登録する
    * 既に該当データが存在する場合は失敗
    * (VB版の英文購読オプション専用処理と統合)
    *
    * @param  : db DBオブジェクト
    * @param  : fregiParam Fregi決済データ
    * @param  : keiriDempyoNo 経理伝票番号
    * @param  : shiken_meisai_id 試験明細ID
    * @param  : notKaiinNo 非会員の会員番号
    * @param  : selOpFlg 英文オプション専用フラグ
    * @return : 成功 true / 失敗 false
    ******************************************************************************/
    public static function insertAccountingDataMember($db, $fregiParam, $keiriDempyoNo, $shiken_meisai_id, $noKaiinNo, $selOpFlg) {

        // テーブルオブジェクトの初期化
        $tb_keiri_joho = new Tb_keiri_joho();

        // パラメータの設定
        $param = array();
        $param['keiri_id'] = null;
        $param['keiri_dempyo_no'] = $keiriDempyoNo;
        $param['id'] = $fregiParam['id'];

        // 会員番号
        if(isset($_SESSION['kaiinNo'])) {
            $param['kaiin_no'] =  $_SESSION['kaiinNo'];
        } else {
            $param['kaiin_no'] =  $noKaiinNo;
        }

        // 英文購読オプション用かどうかの判定
        if($selOpFlg == true) {
            $param['keiri_shumoku_cd_1'] = '10'; // 英文購読オプション
            $param['keiri_shumoku_cd_2'] = null;
            $param['keiri_shumoku_cd_3'] = null;
        } else {
            $param['keiri_shumoku_cd_1'] = isset($_SESSION['keiri_shumoku_cd_1']) ? $_SESSION['keiri_shumoku_cd_1'] : null;
            $param['keiri_shumoku_cd_2'] = isset($_SESSION['keiri_shumoku_cd_2']) ? $_SESSION['keiri_shumoku_cd_2'] : null;
            $param['keiri_shumoku_cd_3'] = isset($_SESSION['keiri_shumoku_cd_3']) ? $_SESSION['keiri_shumoku_cd_3'] : null;
        }
        $param['ceu_id'] = null;
        $param['ceu_meisai_id'] = null;
        $param['hpc_yoyaku_id'] = null;
        $param['etc_id'] = null;
        $param['etc_meisai_id'] = null;
        $param['exa_id'] = null;

        // 試験明細ID
        if($shiken_meisai_id = 0) {
            $param['shiken_meisai_id'] = null;
        } else {
            $param['shiken_meisai_id'] = $shiken_meisai_id;
        }

        $param['keiri_nyuryokubi'] = date('Y/m/d');
        $param['hoken_id'] = null;
        $param['nonyubi'] = null;
        $param['nonyu_kingaku'] = null;
        $param['keiri_biko'] = null;

        // 支払方法
        switch($fregiData['pay_type_specify']) {
            case FregiConfig::PAY_TYPE_CARD :
                $param['nonyu_hoho_kbn'] = Config::GEUM_PAY_CARD;
                break;
            case FregiConfig::PAY_TYPE_CONVENIENCE :
                $param['nonyu_hoho_kbn'] = Config::GEUM_PAY_CONVENIENCE;
                break;
            case FregiConfig::PAY_TYPE_PAYEASY :
                $param['nonyu_hoho_kbn'] = Config::GEUM_PAY_PAYEASY;
                break;
        }

        $param['shikentoshi'] = null;
        $param['fusoku_flg'] = null;
        $param['naiyo'] = null;
        $param['sakujo_flg'] = 0;
        $param['sakusei_user_id'] = $param['koshin_user_id'] = payment_constants::USER_ID;
        $param['sakusei_nichiji'] = $param['koshin_nichiji'] = date('Y/m/d H:i:s');

        // すでに該当データが存在するかを確認
        $keiri_joho = $tb_keiri_joho->findByKeiriDempyoNoAndId($param);

        // 該当データが存在しない場合、経理情報テーブルを新規登録する
        if(empty($keiri_joho)) {
            return $tb_keiri_joho->insertRec_noTran($db, $param);
        } else {
            return false;
        }
    }


}