(function ($) {
    $(document).ready(function () {
        /****************
        * 試験明細
        * データ取得
        ****************/
        $.ajax({
            url: '../../classes/getTbShikenMeisai.php',
        }).done((rtn) => {
            console.log(1);
            if (rtn == 0) {
                //CSCS資格なしの場合、【両方(基礎化学、実践／応用)】出願
                //NSCA_CPT資格なしの場合、【受験】出願
                $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                $("#comment_nsca_cpt").text("【受験】出願へ");
                $("#cscs_shikaku").val("両方");
                
            } else {
                console.log(rtn);
                getJukenJotaiKbn = JSON.parse(rtn);
                $.each(getJukenJotaiKbn, function (i, value) {
                    if (value['shiken_sbt_kbn'] == 1) {
                        //CSCS
                        if (value['juken_jotai_kbn'] == 4) {
                            //受験状態区分が4(受験期間)の場合で、
                            //実践のみ未合格の場合は【実践／応用】出願
                            //基礎のみ未合格の場合は【基礎化学】出願
                            //両方とも未合格の場合は【両方(基礎化学、実践／応用)】出願
                            if (value['kiso_gohi_kbn'] == 0 && value['jissen_gohi_kbn'] == 0) {
                                $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                                $("#cscs_shikaku").val("両方");
                            } 
                            else if (value['jissen_gohi_kbn'] == 0) {
                                $("#comment_cscs").text("【実践／応用】出願へ");
                                $("#cscs_shikaku").val("実践のみ");
                            } else if (value['kiso_gohi_kbn'] == 0) {
                                $("#comment_cscs").text("【基礎化学】出願へ");
                                $("#cscs_shikaku").val("基礎のみ");
                            }

                        } else if (value['juken_jotai_kbn'] == 6 && value['cbt_saijuken_kbn'] == 0) {
                            //受験状態区分が6(受験済み)の場合で、CBR再受験区分がない場合、【両方(基礎化学、実践／応用)】出願
                            $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                            $("#cscs_shikaku").val("両方");
                        }
                    } else {

                        //NSCA_CPT
                        if (value['juken_jotai_kbn'] == 4) {
                            //受験状態区分が4(受験期間)の場合、【受験】出願
                            $("#comment_nsca_cpt").text("【受験】出願へ");
                        } else if (value['juken_jotai_kbn'] == 6 && value['cbt_saijuken_kbn'] == 0) {
                            //受験状態区分が6(受験済み)の場合で、CBR再受験区分がない場合、【受験済み】再度出願
                            $("#comment_nsca_cpt").text("【受験済み】再度出願へ");
                        }
                    }
                });
            }
        }).fail((rtn) => {
            console.log(0);
            return false;
        });

        //受験料を格納する変数
        var cscs_jukenryo = "";
        var cscs_1_jukenryo = "";
        var cpt_jukenryo = "";

        // 受験料データ取得処理
        $.ajax({
            url: '../../classes/getJukenryoData.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
                console.log(wk_cmControl);
                cscs_jukenryo = Math.floor(wk_cmControl["cscs_jukenryo"]).toLocaleString();            
                cscs_1_jukenryo = Math.floor(wk_cmControl["cscs_jukenryo_1_kamoku"]).toLocaleString();          
                cpt_jukenryo = Math.floor(wk_cmControl["cpt_jukenryo"]).toLocaleString();             
            }
        }).fail((rtn) => {
            return false;
        });


        $("#cscs").click(function () {
            $("#shiken_sbt").val(1);
            if ($("#cscs_shikaku").val() == "両方") {
                $("#jukenryo").val(cscs_jukenryo);
            } else {
                $("#jukenryo").val(cscs_1_jukenryo);
            }
            url = '../inputCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

        $("#nsca_cpt").click(function () {
            $("#shiken_sbt").val(2);
            $("#jukenryo").val(cpt_jukenryo);
            url = '../inputCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });

})(jQuery);