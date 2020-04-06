(function ($) {
    $(document).ready(function () {

        //エラーメッセージエリア初期化
        $("#error_message").html("");
        $("#error_message_sbt").html("");

        // 会費データ取得処理
        $.ajax({
                url: '../../classes/Common/searchPostNo.php',
            type: 'POST',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                $("#err_message").html("会費データが取得できません");
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
                $("#seikaiin-kaihi").html(Math.floor(wk_cmControl['kaihi_seikaiin']).toLocaleString());           //※ここに配列の20番目をカンマ編集してセット
                $("#gakusei-kaihi").html(Math.floor(wk_cmControl['kaihi_gakuseikaiin']).toLocaleString());            //※ここに配列の21番目をカンマ編集してセット
            }
        }).fail((rtn) => {
            $("#err_message").html("会費データが取得できません");
            return false;
        });

        //会員種別を格納する変数
        wk_kaiin_sbt = "";

        //会員種別取得処理
        $.ajax({
            url: '../../classes/getKaiinSbt.php',
            type: 'POST',
        }).done((rtn) => {
            console.log(rtn);
            wk_kaiin_sbt = JSON.parse(rtn);
            if (wk_kaiin_sbt['kaiin_sbt_kbn'] == 1) {
                $("#kaiin_sbt").text("NSCA正会員");
            } else if (wk_kaiin_sbt['kaiin_sbt_kbn'] == 2) {
                $("#kaiin_sbt").text("学生会員");
            } else {
                $("#err_message_sbt").html("会員種別データが取得できません");
                return false;
            }
        }).fail((rtn) => {
            $("#err_message_sbt").html("会員種別データが取得できません");
            return false;
        });

        /******************************************
         * NSCA正会員への変更ボタン押下処理
         ******************************************/
        $("#__changeMember").click(function () {
            if (wk_kaiin_sbt['kaiin_sbt_kbn'] == 1) {
                //現在の会員種別がNSCA正会員の場合メッセージを表示する
                $("#err_message_sbt").html("すでにNSCA正会員です。");
                return false;
            } else {
                $('#kaiinSbt').val(1);                                                             //※HIDDEN項目のkaiinSbtに利用登録の値：1をセット
                $('#kaihi').val(Math.floor(wk_cmControl['20']).toLocaleString());                  //※HIDDEN項目のkaihiに利用登録の値：13,200をセット          
                url = '../continueMember/';
                $('form').attr('action', url);
                $('form').submit();
            }
        });

        /******************************************
        * 学生会員への変更ボタン押下処理
        ******************************************/
        $("#__changeGakusei").click(function () {
            if (wk_kaiin_sbt['kaiin_sbt_kbn'] == 2) {
                //現在の会員種別が学生会員の場合メッセージを表示する
                $("#err_message_sbt").html("すでに学生会員です。");
                return false;
            } else {
                $('#kaiinSbt').val(2);                                                             //※HIDDEN項目のkaiinSbtに利用登録の値：2をセット
                $('#kaihi').val(Math.floor(wk_cmControl['21']).toLocaleString());                  //※HIDDEN項目のkaihiに利用登録の値：11,000をセット          
                url = '../continueMember/';
                $('form').attr('action', url);
                $('form').submit();
            }
        });
    });
})(jQuery);
