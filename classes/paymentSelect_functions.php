<?php
namespace Was;

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
require './DBAccess/Tb_kaiin_ceu.php';
require './DBAccess/Tb_kaiin_sentaku.php';
require './DBAccess/Tb_kessai_hakko.php';

/*************************************************************************************************************************************
* PaymentSelect内で使用する汎用的な関数を定義するクラス
*************************************************************************************************************************************/
Class paymentSelect_functions {
    
    // メンバ
    private $cons;
    private $fregiCons;
    private $payCons;
    private $cm_control;
    private $tb_kaiin_joho;
    private $tb_kaiin_jotai;
    private $tb_kaiin_journal;
    private $tb_kaiin_sonota;
    private $tb_kaiin_pick_up;
    private $tb_kaiin_nintei;
    private $tb_kaiin_ceu;
    private $tb_kaiin_sentaku;
    private $tb_kessai_hakko;

    // コンストラクタ
    public function __construct() {
        $this->cons = new Config();
        $this->fregiCons = new FregiConfig();
        $this->payCons = new paymentSelect_constants();
        $this->cm_control = new Cm_control();
        $this->tb_kaiin_joho = new Tb_kaiin_joho();
        $this->tb_kaiin_jotai = new Tb_kaiin_jotai();
        $this->tb_kaiin_journal = new Tb_kaiin_journal();
        $this->tb_kaiin_sonota = new Tb_kaiin_sonota();
        $this->tb_kaiin_pick_up = new Tb_kaiin_pick_up();
        $this->tb_kaiin_nintei = new Tb_kaiin_nintei();
        $this->tb_kaiin_ceu = new Tb_kaiin_ceu();
        $this->tb_kaiin_sentaku = new Tb_kaiin_sentaku();
        $this->tb_kessai_hakko = new Tb_kessai_hakko();    
    }

    /*****************************************************************************
    * F-Regi決済用の連番を取得する
    * @return : 決済連番
    ******************************************************************************/
    public function getFregiId() {
        $result = null;

        // 決済連番をカウントアップする 
        if ($this->cm_control->countUpKessaiRemban()) {
            // 決済連番を取得
            $result = $this->cm_control->getKessaiRemban();
        }

        if (empty($result)) {
            // 該当データなしの場合
            return 0;
        } else {
            // 該当データありの場合
            return $result;
        }
    }

    /*****************************************************************************
    * すでに認定校生データが存在するかを確認し、存在した場合に会員番号を返す
    *
    * @param  : param 会員データ
    * @return : 会員番号
    ******************************************************************************/
    public function getKaiinNoForMemberCertificate($param) {

        $kaiin_joho = $this->tb_kaiin_joho->findNinteiKousei($param);

        if(empty($kaiin_joho)) {
            return null;
        } else {
            return $kaiin_joho['kaiin_no'];
        }
    }

    /*****************************************************************************
    * すでに認定校生データが存在するかを確認し、存在した場合に会員番号を返す
    *
    * @param  : oldKaiinNo 旧会員番号
    * @param  : payType 支払方法タイプ
    * @param  : certificateFlg 認定校フラグ
    ******************************************************************************/
    public function insertMemberData($oldKaiinNo, $payType, $certificateFlg) {

        // パラメータの設定
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
        $web_nyukai = 1 // Web入会区分：Web
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
        if(empty($kaiin_no)) return;

        // 2) tb_kaiin_joho の登録
        // 認定校生の場合、備考を引き継ぐ
        if($certificateFlg == 1) {
            $old_kaiin_joho = $this->tb_kaiin_joho->findNinteiKousei($param);
            if(!empty($old_kaiin_joho)) $param['biko'] = $old_kaiin_joho['biko'];
        }
        $param['toroku_jokyo_kbn'] = $toroku_jokyo;
        $param['kaiin_jokyo_kbn'] = $kaiin_jokyo;
        $param['country'] = $country;
        $param['web_nyukai_kbn'] = $web_nyukai;
        $this->tb_kaiin_joho->insertRec($param);

        // 3) tb_kaiin_jotai の登録
        $param['gakuseisho_kakunin_kbn'] = $gakuseisho_kakunin;
        $this->tb_kaiin_jotai->insertRec($param);

        // 4) tb_kaiin_journal の登録
        $param['journal_hasso_kbn'] = $journal_hasso;
        $param['journal_hassosu'] = $journal_hasso_cnt;
        $param['beikoku_website_id_kbn'] = $usa_website_id;
        $param['kaigai_hasso_id_tsuchi_kbn'] = $kaigai_hasso_id_tsuchi;
        $this->tb_kaiin_journal->insertRec($param);

        // 5) tb_kaiin_sonota の登録
        $param['card_toroku'] = $card_toroku;
        $this->tb_kaiin_sonota->insertRec($param);

        // 6) tb_kaiin_pick_up の登録
        $this->tb_kaiin_pick_up->insertRec($param);

        // 認定校生以外の場合に新規登録
        if($certificateFlg == 0) {
            // 7) tb_kaiin_nintei の登録
            $this->tb_kaiin_nintei->insertRec($param);

            // 8-1) tb_kaiin_ceu(CSCS)
            $param['shiken_sbt_kbn'] = $shiken_sbt_cscs;
            $this->tb_kaiin_ceu->insertRec($param);

            // 8-2) tb_kaiin_ceu(CPT)
            $param['shiken_sbt_kbn'] = $shiken_sbt_cpt;
            $this->tb_kaiin_ceu->insertRec($param);
        }

        // 9) tb_kaiin_sentaku は、別で登録
        // 10) 会員番号をセッションに保存
        return $kaiin_no;
    }

    /*****************************************************************************
    * 会員種別によって採番後の新しい会員番号を返却する
    *
    * @param  : kaiin_sbt_kbn 会員種別
    * @return : 採番後の新しい会員番号
    ******************************************************************************/
    public function getNewKaiinNo($kaiin_sbt_kbn) {
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
            $strToday = (new DateTime())->format('ymd');
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByBetween(
                '8' .$strToday .'01', 
                '8' .$strToday .'99'
            );
            
            if(empty($kaiin_joho)) {
                return '8' .$strToday .'01';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }

        } else if($kaiin_sbt_kbn == $ippan
            || $kaiin_sbt_kbn == $nenkan
            || $kaiin_sbt_kbn == $tanpatsu
            || $kaiin_sbt_kbn == $provider
        ) {
            // 一般、年間協賛、単発協賛 (7番台)
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByLike('70%');
            
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
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByLike('50%');
            
            if(empty($kaiin_joho)) {
                return '500000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }
        
        } else if($kaiin_sbt_kbn == $nintei) {
            // 認定校生 (4番台)
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByLike('4%');
            
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
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByLike('3%');
            
            if(empty($kaiin_joho)) {
                return '300000001';
            } else {
                return strval(intval($kaiin_joho['kaiin_no']) + 1);
            }

        } else if($kaiin_sbt_kbn == $beikoku) {
            // 米国会員(USA)
            $kaiin_joho = $this->tb_kaiin_joho->getMaxKaiinNoByLike('USA%');
            
            if(empty($kaiin_joho)) {
                return 'USA000001';
            } else {
                $intKaiinNo = intval(subStr($kaiin_joho['kaiin_no'], -6));
                return 'USA' .sprintf('%06d', strval($intKaiinNo + 1));
            }
        }
        return 0;
    }





}