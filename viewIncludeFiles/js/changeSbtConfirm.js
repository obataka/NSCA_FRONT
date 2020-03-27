(function ($) {
    $(document).ready(function () {
        /******************************************
         *会員種別選択変更ボタン押下処理
         ******************************************/
        $("#back").click(function () {
            location.href = "../../changeSbt/";
        });
        /******************************************
        *現在の会員種別取得処理
        ******************************************/
        //会員種別を格納する変数
        var wk_kaiin_sbt;
        $.ajax({
            url: '../../classes/getKaiinSbt.php',
            type: 'POST',
        }).done((rtn) => {
            console.log(rtn);
            wk_kaiin_sbt = JSON.parse(rtn);
            if (wk_kaiin_sbt[0] == 0) {
                $("#kaiin_sbt_currnt").text("利用会員(無料)");
            } else if (wk_kaiin_sbt[0] == 1) {
                $("#kaiin_sbt_currnt").text("NSCA正会員");
            } else if (wk_kaiin_sbt[0] == 2) {
                $("#kaiin_sbt_currnt").text("学生会員");
            } else {
                return false;
            }
        }).fail((rtn) => {
            return false;
        });

        //会費データを格納する変数
        var wk_kaihi;
        // 会費データ取得処理
        $.ajax({
            url: '../../classes/getKaihiData.php',
            type: 'POST',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
                //会費データ表示処理
                if (wk_kaiin_sbt[0] == 0) {
                    $("#kaihi_currnt").text("無料");
                } else if (wk_kaiin_sbt[0] == 1) {
                    wk_kaihi = Math.floor(wk_cmControl['20']).toLocaleString() + "円";
                    $("#kaihi_currnt").text(wk_kaihi);
                } else if (wk_kaiin_sbt[0] == 2) {
                    wk_kaihi = Math.floor(wk_cmControl['21']).toLocaleString() + "円";
                    $("#kaihi_currnt").text(wk_kaihi);
                } else {
                    return false;
                }
            }
        }).fail((rtn) => {
            return false;
        });

        /******************************************
         *変更ボタン押下処理
         ******************************************/
        $("#next").click(function () {
            //現在の会員種別が無料会員の場合、新規登録画面に遷移する。
            //それ以外の場合、継続手続きのお願いへ画面遷移する。
            if (wk_kaiin_sbt[0] == 0) {
                url = '../../registMember/';
                $('form').attr('action', url);
                $('form').submit();
            } else {
                url = '../../continueRequest/';
                $('form').attr('action', url);
                $('form').submit();
            }
        });
    });
})(jQuery);
