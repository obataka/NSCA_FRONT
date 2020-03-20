(function ($) {
    $(document).ready(function () {

        //試験情報取得

        //試験名を格納する変数
        var shiken_mei = "";

        //会員情報を格納する変数
        var kaiin_no = "";
        var name = "";
        var address = "";

        jQuery.ajax({
            url: '../../classes/getShutuganJokyo.php',
        }).done((rtn) => {
            getShutuganJokyo = JSON.parse(rtn);
            $.each(getShutuganJokyo, function (i, val) {
                if (val['shiken_meisai_id'] == $('#shiken_meisai_id').val()) {
                    //試験種別から名称取得し、表示する
                    var shiken_sbt = val['shiken_sbt_kbn'];

                    //科目選択区分
                    var kamoku_kbn = val['kamoku_sentaku_kbn'];

                    jQuery.ajax({
                        url: '../../classes/getShikenSbt.php',
                    }).done((rtn) => {
                        getShikenSbt = JSON.parse(rtn);
                        $.each(getShikenSbt, function (i, val) {
                            if (val['meisho_cd'] == shiken_sbt) {
                                
                                //試験種別がCSCSの場合、科目選択区分に応じて追記表示する
                                if (shiken_sbt == 1) {
                                    switch (kamoku_kbn) {
                                        case '1':
                                            //両方
                                            shiken_mei = val['meisho'] + '認定試験【両方(基礎科学、実践／応用)】';
                                            break;
                                        case '2':
                                            //基礎
                                            shiken_mei = val['meisho'] + '認定試験【基礎科学】';
                                            break;
                                        case '3':
                                            //実践
                                            shiken_mei = val['meisho'] + '認定試験【実践／応用】';
                                            break;
                                    }
                                } else {
                                    //試験種別を表示
                                    shiken_mei = val['meisho'] + '認定試験';
                                }

                                //会員情報取得
                                jQuery.ajax({
                                    url: '../../classes/getTbkaiinJoho.php',
                                }).done((rtn) => {
                                    getKaiinJoho = JSON.parse(rtn);

                                    kaiin_no = getKaiinJoho[0];
                                    //氏名とメールアドレス表示
                                    $('#name').append(getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei'] + ' 様');

                                    name = getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei'] + ' 様';
                                    //アドレスを変数に格納する
                                    var mail_1 = getKaiinJoho['email_1'];
                                    var mail_2 = getKaiinJoho['email_2'];

                                    //TB会員その他取得
                                    jQuery.ajax({
                                        url: '../../classes/getTbkaiinSonota.php',
                                    }).done((rtn) => {
                                        getKaiinSonota = JSON.parse(rtn);

                                        //お知らせ受信用のアドレスを表示
                                        if (getKaiinSonota['email_1_oshirase_uketori'] != "") {
                                            $('#address').append(mail_1);
                                            address = mail_1;
                                        } else if (getKaiinSonota['email_2_oshirase_uketori'] != "") {
                                            $('#address').append(mail_2);
                                            address = mail_2;
                                        }

                                        //本文初期表示処理
                                        $('#mail_honbun').val('特定非営利活動法人 NSCAジャパン 事務局 御中\n\n' +
                                            '認定試験の試験期間延長を申込みます。\n\n' +

                                            '※事務局から受験延長を受け付ける返信があるまで、マイページの表示は変更されません。\n\n' +

                                            '【会員番号】 ' + kaiin_no + '\n' +
                                            '【氏名】 ' + name + '\n' +
                                            '【受験資格】 ' + shiken_mei + '\n' +
                                            '【メール】 ' + address
                                        );

                                    }).fail((rtn) => {
                                        return false;
                                    });


                                }).fail((rtn) => {
                                    return false;
                                });

                            }

                        });
                    }).fail((rtn) => {
                        return false;
                    });

                }
            });

        }).fail((rtn) => {
            return false;
        });


        /***************************************
        * 送信ボタン押下時、メールを送信する
        ****************************************/
        $("#__send").click(function () {
            //エラーメッセージエリア初期化
            $("#err_mail").html("");

            var wk_err_msg = "";
            var wk_focus_done = 0;

            //本文未入力チェック
            if ($("#mail_honbun").val() == "") {
                wk_err_msg = "本文が入力されていません。本文を入力してください。";
                $("#err_mail").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#mail_honbun").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            } else {
                jQuery.ajax({
                    url: '../../classes/sendExtensionApplicationMail.php',
                    type: 'POST',
                    data:
                    {
                        message: $('#mail_honbun').val(),
                        mail_address: address,
                    },
                }).done((rtn) => {
                    if (rtn == 0) {
                        wk_err_msg = "メールの送信に失敗しました。";
                        $("#err_mail").html(wk_err_msg);
                        return false;
                    } else {
                        location.href = '../../extensionApplicationComplete/';
                    }
                }).fail((rtn) => {
                    wk_err_msg = "メールの送信に失敗しました。";
                    $("#err_mail").html(wk_err_msg);
                    return false;
                });
            }
        });

        /***************************************
        * 出願状況確認へボタン押下時、一つ前の画面に戻る
        ****************************************/
        $("#__goBack").click(function () {
            location.href = '../../checkEntryStatus/';
        });

    });
})(jQuery);
