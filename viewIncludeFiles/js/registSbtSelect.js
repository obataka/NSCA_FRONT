(function ($) {
    $(document).ready(function () {

        //エラーメッセージエリア初期化
        $(".error").html("");

        // 会費データ取得処理
        jQuery.ajax({
            url: '../../classes/getKaihiData.php',
            type: 'POST',
            success: function (rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    $("#err_message").html("会費データが取得できません");
                    return false;
                } else {
                    wk_cmControl = JSON.parse(rtn);
                    $("#seikaiin-kaihi").html(Math.floor(wk_cmControl['20']).toLocaleString());           //※ここに配列の20番目をカンマ編集してセット
                    $("#gakusei-kaihi").html(Math.floor(wk_cmControl['21']).toLocaleString());            //※ここに配列の21番目をカンマ編集してセット
                }
            },
            fail: function (rtn) {
                $("#err_message").html("会費データが取得できません");
                return false;
            },
            error: function (rtn) {
                $("#err_message").html("会費データが取得できません");
                return false;
            }
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















        //        /********************************
        //         * ログインボタン押下処理
        //         ********************************/
        //        $("#__send").click(function() {
        //
        //            // エラーメッセージエリア初期化
        //            $(".error").text("");
        //
        //            var wk_focus_done = 0;
        //            var wk_err_msg = "";
        //
        //            // ID未入力チェック
        //            if ($("#login_id").val() == "") {
        //                if (wk_err_msg == "") {
        //                    wk_err_msg = "ログインIDが未入力です。";
        //                } else {
        //                    wk_err_msg = wk_err_msg + "<br>" + "ログインIDが未入力です。";
        //                }
        //                if (wk_focus_done == 0) {
        //                    $("#login_id").focus();
        //                    wk_focus_done = 1;
        //                }
        //            }
        //
        //            // パスワード未入力チェック
        //            if ($("#password").val() == "") {
        //                if (wk_err_msg == "") {
        //                    wk_err_msg = "パスワードが未入力です。";
        //                } else {
        //                    wk_err_msg = wk_err_msg + "<br>" + "パスワードが未入力です。";
        //                }
        //                if (wk_focus_done == 0) {
        //                    $("#password").focus();
        //                    wk_focus_done = 1;
        //                }
        //            }
        //
        //            if (wk_err_msg != "") {
        //                $(".error").html(wk_err_msg);
        //                return false;
        //            }
        //
        //            var wk_sts = 0;
        //
        //            // ログイン処理
        //            jQuery.ajax({
        //                url:  '../../classes/loginCtrl.php',
        //                type: 'POST',
        //                async:false,
        //                data:
        //                {
        //                    loginId: $("#login_id").val(),
        //                    loginPswd: $("#password").val()
        //                },
        //                success: function(rtn) {
        //alert("rtn=[" + rtn + "]");
        //                    // rtn = 0 の場合は、該当者なし
        //                    if (rtn == 0) {
        //                        $(".error").text("ログイン情報が無効です");
        //                        wk_sts = 1;
        //                        return false;
        //                    }
        //                },
        //                fail: function(rtn) {
        //alert("fail");
        //                    $(".error").text("ログイン情報が無効です");
        //                    wk_sts = 1;
        //                    return false;
        //                },
        //                error: function(rtn) {
        //alert("error");
        //                    $(".error").text("ログイン情報が無効です");
        //                    wk_sts = 1;
        //                    return false;
        //                }
        //            });
        //
        //            if (wk_sts == 1) {
        //                return false;
        //            }
        //        });
    });
})(jQuery);
