(function ($) {
    $(document).ready(function () {
        /****************
        * 試験明細
        * データ取得
        ****************/
        jQuery.ajax({
            url: '../../classes/getTbShikenMeisai.php',
        }).done((rtn) => {
            if (rtn == 0) {
                //CSCS資格なしの場合、【両方(基礎化学、実践／応用)】出願
                //NSCA_CPT資格なしの場合、【受験】出願
                $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                $("#comment_nsca_cpt").text("【受験】出願へ");
                $("#cscs_shikaku").val("両方");
                
            } else {
                getJukenJotaiKbn = JSON.parse(rtn);
                $.each(getJukenJotaiKbn, function (i, value) {
                    if (value[0] == 1) {
                        //CSCS
                        if (value[1] == 4) {
                            //受験状態区分が4(受験期間)の場合で、
                            //実践のみ未合格の場合は【実践／応用】出願
                            //基礎のみ未合格の場合は【基礎化学】出願
                            //両方とも未合格の場合は【両方(基礎化学、実践／応用)】出願
                            if (value[3] == 0 && value[4] == 0) {
                                $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                                $("#cscs_shikaku").val("両方");
                            } 
                            else if (value[4] == 0) {
                                $("#comment_cscs").text("【実践／応用】出願へ");
                                $("#cscs_shikaku").val("実践のみ");
                            } else if (value[3] == 0) {
                                $("#comment_cscs").text("【基礎化学】出願へ");
                                $("#cscs_shikaku").val("基礎のみ");
                            }

                        } else if (value[1] == 6 && value[2] == 0) {
                            //受験状態区分が6(受験済み)の場合で、CBR再受験区分がない場合、【両方(基礎化学、実践／応用)】出願
                            $("#comment_cscs").text("【両方(基礎化学、実践／応用)】出願へ");
                            $("#cscs_shikaku").val("両方");
                        }
                    } else {

                        //NSCA_CPT
                        if (value[1] == 4) {
                            //受験状態区分が4(受験期間)の場合、【受験】出願
                            $("#comment_nsca_cpt").text("【受験】出願へ");
                        } else if (value[1] == 6 && value[2] == 0) {
                            //受験状態区分が6(受験済み)の場合で、CBR再受験区分がない場合、【受験済み】再度出願
                            $("#comment_nsca_cpt").text("【受験済み】再度出願へ");
                        }
                    }
                });
            }
        }).fail((rtn) => {
            return false;
        });

        $("#cscs").click(function () {
            $("#shikaku_sbt").val(1);
            url = '../inputCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

        $("#nsca_cpt").click(function () {
            $("#shikaku_sbt").val(2);
            url = '../inputCSCSCPT/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });

});