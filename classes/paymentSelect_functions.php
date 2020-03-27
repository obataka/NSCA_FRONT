<?php
namespace Was;

require './Config/Config.php';
require './Config/FregiConfig.php';
require './paymentSelect_constants.php';
require './DBAccess/Db.php';
require './DBAccess/Cm_control.php';
require './DBAccess/Tb_kaiin_joho.php';
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
    private $tb_kessai_hakko;

    // コンストラクタ
    public function __construct() {
        $this->cons = new Config();
        $this->fregiCons = new FregiConfig();
        $this->payCons = new paymentSelect_constants();
        $this->cm_control = new Cm_control();
        $this->tb_kaiin_joho = new Tb_kaiin_joho();
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

        $data = $this->tb_kaiin_joho->findNinteiKousei($param);

        if(empty($data)) {
            return null;
        } else {
            return $data['kaiin_no'];
        }
    }

    /*****************************************************************************
    * すでに認定校生データが存在するかを確認し、存在した場合に会員番号を返す
    *
    * @param  : param 会員データ
    ******************************************************************************/
    public function insertMemberData($param) {

        // 1) 会員番号を取得
        $kaiin_no 
        // 2) tb_kaiin_joho の登録
        // 3) tb_kaiin_jotai の登録
        // 4) tb_kaiin_jounal の登録
        // 5) tb_kaiin_sonota の登録
        // 6) tb_kaiin_pick_up の登録
        // 7) tb_kaiin_nintei の登録
        // 8-1) tb_kaiin_ceu(CSCS)
        // 8-2) tb_kaiin_ceu(CPT)
        // 9) tb_kaiin_sentaku は、別で登録
        // 10) 会員番号の返却
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
            

        } else if($kaiin_sbt_kbn == $ippan
            || $kaiin_sbt_kbn == $nenkan
            || $kaiin_sbt_kbn == $tanpatsu
            || $kaiin_sbt_kbn == $provider
        ) {
            // 一般、年間協賛、単発協賛 (7番台)

        } else if($kaiin_sbt_kbn == $yakuin
            || $kaiin_sbt_kbn == $gaibu
            || $kaiin_sbt_kbn == $sonota
            || $kaiin_sbt_kbn == $toshokan
        ) {
            // 役員、外部講師、その他、図書館 (5番台)
        
        } else if($kaiin_sbt_kbn == $nintei) {
            // 認定校生 (4番台)
        
        } else if($kaiin_sbt_kbn == $sanjoKigyo
            || $kaiin_sbt_kbn == $sanjoGakko
            || $kaiin_sbt_kbn == $ninteiko
        ) {
            // 賛助企業、賛助学校、認定校 (3番台)

        } else if($kaiin_sbt_kbn == $beikoku) {
            // 米国会員(USA)
        }

    }







}