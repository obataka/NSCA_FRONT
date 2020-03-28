(function ($) {
    $(document).ready(function () {
        /********************************
        * 初期表示処理
        ********************************/
        //試験情報取得

        //試験名を格納する変数
        var shiken_mei = "";

        //会員情報を格納する変数
        var kaiin_no = "";
        var name = "";
        var address = "";

        $.ajax({
            url: '../../classes/getShutuganJokyo.php',
        }).done((rtn) => {
            getShutuganJokyo = JSON.parse(rtn);
            console.log(getShutuganJokyo);
            $.each(getShutuganJokyo, function (i, val) {
                if (val['shiken_meisai_id'] == $('#shiken_meisai_id').val()) {
                    //試験種別から名称取得し、表示する
                    var shiken_sbt = val['shiken_sbt_kbn'];

                    //科目選択区分
                    var kamoku_kbn = val['kamoku_sentaku_kbn'];

                    $.ajax({
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
                                            $('#shiken_sbt').append(val['meisho'] + '認定試験<br>両方(基礎科学、実践／応用)');
                                            shiken_mei = val['meisho'] + '認定試験【両方(基礎科学、実践／応用)】';
                                            break;
                                        case '2':
                                            //基礎
                                            $('#shiken_sbt').append(val['meisho'] + '認定試験<br>【基礎科学】');
                                            shiken_mei = val['meisho'] + '認定試験【基礎科学】';
                                            break;
                                        case '3':
                                            //実践
                                            $('#shiken_sbt').append(val['meisho'] + '認定試験<br>【実践／応用】');
                                            shiken_mei = val['meisho'] + '認定試験【実践／応用】';
                                            break;
                                    }
                                } else {
                                    //試験種別を表示
                                    $('#shiken_sbt').append(val['meisho'] + '認定試験<br>');
                                    shiken_mei = val['meisho'] + '認定試験';
                                }

                                //会員情報取得
                                $.ajax({
                                    url: '../../classes/getTbkaiinJoho.php',
                                }).done((rtn) => {
                                    getKaiinJoho = JSON.parse(rtn);

                                    kaiin_no = getKaiinJoho[0];
                                    //氏名とメールアドレス表示
                                    $('#name').append(getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei'] + ' 様');

                                    name = getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei'] + ' 様'
                                    //アドレスを変数に格納する
                                    var mail_1 = getKaiinJoho['email_1'];
                                    var mail_2 = getKaiinJoho['email_2'];

                                    //TB会員その他取得
                                    $.ajax({
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
                                        $('#text').val('特定非営利活動法人 NSCAジャパン 事務局 御中\n\n' +
                                            '認定試験の申し込みを取り消します。\n\n' +
                                            '【会員番号】 ' + kaiin_no + '\n' +
                                            '【氏名】 ' + name + '\n' +
                                            '【受験資格】 ' + shiken_mei + '\n' +
                                            '【メール】 ' + address + '\n\n' +

                                            '＜お支払い済みの方＞\n' +
                                            '有効な受験期間が切れる1週間前までに申込の取り消しを行われた場合は、違約金(50％)、\n' +
                                            '事務手数料(1,080円)を差し引いで返金いたしますので、返金先情報を以下にご記入ください。\n\n' +

                                            '※事務局から受験キャンセルを受け付ける返信があるまで、マイページの表示は変更されません。\n\n' +

                                            '――――――――――――――――――\n' +
                                            '【銀行名】\n' +
                                            '【支店名】\n' +
                                            '【口座種別】\n' +
                                            '【口座番号】\n' +
                                            '【名義(カタカナ)】\n' +
                                            '――――――――――――――――――');

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

                    //返金額表示処理
                    //CSCS受験で1科目の場合はCSCS受験料1科目を表示する
                    //2科目の場合はCSCS受験料を表示する
                    $.ajax({
                        url: '../../classes/getCmControl.php',
                    }).done((rtn) => {
                        getCmControl = JSON.parse(rtn);
                        var cscs_jukenryo = Math.floor(val['cscs_jukenryo']) * 0.5 - 1080;
                        var cscs_jukenryo_1_kamoku = Math.floor(val['cscs_jukenryo_1_kamoku']) * 0.5 - 1080;
                        var cpt_jukenryo = Math.floor(val['cpt_jukenryo']) * 0.5 - 1080;

                        if (shiken_sbt == 1) {
                            if (kamoku_kbn == 1) {
                                $('#henkin').append(cscs_jukenryo + '円');
                            } else {
                                $('#henkin').append(cscs_jukenryo_1_kamoku + '円');
                            }
                        } else if (shiken_sbt == 2) {
                            $('#henkin').append(cpt_jukenryo + '円');
                        }
                    }).fail((rtn) => {
                        return false;
                    });

                }
            });

        }).fail((rtn) => {
            return false;
        });


        /********************************
       * 出願状況確認画面へボタン押下時
       ********************************/
        $('#return').click(function () {
            location.href = '../../checkEntryStatus/';
        });

        /********************************
        * 送信ボタン押下時
        ********************************/
        $('#send').click(function () {

            //エラーメッセージエリア初期化
            $("#err_mail").html("");

            var wk_err_msg = "";
            var wk_focus_done = 0;

            //本文未入力チェック
            if ($("#text").val() == "") {
                wk_err_msg = "本文が入力されていません。本文を入力してください。";
                $("#err_mail").html(wk_err_msg);
                //エラー箇所にフォーカスを当てる
                if (wk_focus_done == 0) {
                    $("#text").focus();
                    wk_focus_done = 1;
                }
            }

            // エラーがある場合は、メッセージを表示し、処理を終了する
            if (wk_err_msg != "") {
                return false;
            } else {
                $.ajax({
                    url: '../../classes/sendEntryCancelMail.php',
                    type: 'POST',
                    data:
                    {
                        message: $('#text').val(),
                        mail_address: address,
                    },
                }).done((rtn) => {
                    console.log(rtn);
                    if (rtn == 0) {
                        wk_err_msg = "メールの送信に失敗しました。";
                        $("#err_mail").html(wk_err_msg);
                        return false;
                    } else if (rtn == 10) {
                        wk_err_msg = "すでにキャンセル処理中です。";
                        $("#err_mail").html(wk_err_msg);
                        return false;
                    } else if (rtn == 1) {
                        location.href = '../../entryCancelComplete/';
                    } else {
                        wk_err_msg = "メールの送信に失敗しました。";
                        $("#err_mail").html(wk_err_msg);
                        return false;
                    }
                }).fail((rtn) => {
                    wk_err_msg = "メールの送信に失敗しました。";
                    $("#err_mail").html(wk_err_msg);
                    return false;
                });
            }
        });

    });
})(jQuery);