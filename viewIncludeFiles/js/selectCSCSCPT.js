(function ($) {
    $(document).ready(function () {
        /****************
        * //試験明細
        * データ取得
        ****************/
        jQuery.ajax({
            url: '../../classes/getTbShikenMeisai.php',
        }).done((rtn) => {
            if (rtn == 0) {
                //CSCS資格なしの場合、【両方(基礎化学、実践／応用)】出願
                url = '../inputCSCSCPT/';
                $('form').attr('action', url);
                $('form').submit();
            } else {
                getJukenJotaiKbn = JSON.parse(rtn);
                if (getJukenJotaiKbn['juken_jotai_kbn'] == 4) {
                    //受験状態区分が4(受験期間)の場合で、
                    //実践のみ未合格の場合は【実践／応用】出願
                    //基礎のみ未合格の場合は【基礎化学】出願
                    //両方とも未合格の場合は【両方(基礎化学、実践／応用)】出願
                    url = '../inputCSCSCPT/';
                    $('form').attr('action', url);
                    $('form').submit();
                } else if (getJukenJotaiKbn['juken_jotai_kbn'] == 6 && getJukenJotaiKbn['cbt_saijuken_kbn'] == 0) {
                    //受験状態区分が6(受験済み)の場合で、CBT再受験区分がない場合、【両方(基礎化学、実践／応用)】出願
                    url = '../inputCSCSCPT/';
                    $('form').attr('action', url);
                    $('form').submit();
                }
            }
        }).fail((rtn) => {
            return false;
        });
    });

});