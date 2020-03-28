(function ($) {
    $(document).ready(function () {

        //エラーメッセージエリア初期化
        $(".error").html("");

        // 会費データ取得処理
        $.ajax({
            url: '../../classes/getKaihiData.php',
            type: 'POST',
        }).done((rtn) =>{
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                $("#err_message").html("会費データが取得できません");
                return false;
            } else {
                wk_cmControl = JSON.parse(rtn);
                $("#seikaiin-kaihi").html(Math.floor(wk_cmControl['20']).toLocaleString());           //※ここに配列の20番目をカンマ編集してセット
                $("#gakusei-kaihi").html(Math.floor(wk_cmControl['21']).toLocaleString());            //※ここに配列の21番目をカンマ編集してセット
            }
        }).fail((rtn) =>{
            $("#err_message").html("会費データが取得できません");
                return false;
        });

        /******************************************
         * 利用登録（無料）登録ボタン押下処理
         ******************************************/
        $("#__registRiyo").click(function () {
            $('#kaiinSbt').val(0);                //※HIDDEN項目のkaiinSbtに利用登録の値：0をセット
            $('#kaihi').val(0);                   //※HIDDEN項目のkaihiに利用登録の値：0をセット          
            url = '../registRiyo/';
            $('form').attr('action', url);
            $('form').submit();
        });


        /******************************************
         * NSCA正会員登録ボタン押下処理
         ******************************************/
        $("#__registMember").click(function () {
            $('#kaiinSbt').val(1);                                                             //※HIDDEN項目のkaiinSbtに利用登録の値：1をセット
            $('#kaihi').val(Math.floor(wk_cmControl['20']).toLocaleString());                  //※HIDDEN項目のkaihiに利用登録の値：13,200をセット          
            url = '../registMember/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /******************************************
        * 学生会員登録ボタン押下処理
        ******************************************/
        $("#__registGakusei").click(function () {
            $('#kaiinSbt').val(2);                                                             //※HIDDEN項目のkaiinSbtに利用登録の値：2をセット
            $('#kaihi').val(Math.floor(wk_cmControl['21']).toLocaleString());                  //※HIDDEN項目のkaihiに利用登録の値：11,000をセット          
            url = '../registMember/';
            $('form').attr('action', url);
            $('form').submit();
        });
    });
})(jQuery);
