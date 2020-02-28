(function ($) {
    $(document).ready(function () {

        //資格表示
        if ($('#chkCSCS').val() == 1) {
            $('#shikaku').append('CSCS<br>');
        }

        if ($('#chkCPT').val() == 1) {
            $('#shikaku').append('NSCA-CPT<br>');
        }

        getPersonalDevelopment = "";
        getKaiinJoho = "";
        /****************
        *会員情報を取得
        *****************/
        $.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            // rtn = 0 の場合
            if (rtn == 0) {
                return false;
            } else {
                getKaiinJoho = JSON.parse(rtn);
                //会員情報を表示する
                $('#kaiin_sbt').val(getKaiinJoho['kaiin_sbt_kbn']);

                //パーソナルディベロップメント情報を取得する
                $.ajax({
                    url: '../../classes/getPersonalDevelopmentData.php',
                    type: 'POST',
                    data: {
                        kaiin_sbt: $('#kaiin_sbt').val()
                    }
                }).done((data) => {
                    getPersonalDevelopment = JSON.parse(data);


                }).fail((data) => {
                    return false;
                });
            }
        }).fail((rtn) => {
            return false;
        });



        //申告ボタン押下時処理
        $("#next").click(function () {
            if (getPersonalDevelopment == "") {
                return false;
            }

            var idx = $('#wk_sel_year').val() - 1;

            //申告済みの年度かチェック
            if (getPersonalDevelopment[idx]['keijo_kbn'] == 1) {
                return false;
            } else {
                console.log(123);
                //TBCEU情報明細を更新する
                $.ajax({
                    url: '../../classes/updateCEUJohoMeisai.php',
                    type: 'POST',
                    data: {
                        ceu_id: getPersonalDevelopment[idx]['ceu_id'],
                    }

                }).done((data) => {
                    if (data == 0) {
                        return false;
                    } else {
                        var shutokubi = "";
                        if (getPersonalDevelopment[idx]['shutokubi'] != "") {
                            shutokubi = getPersonalDevelopment[idx]['shutokubi'];
                        }

                        //TB会員CEUを更新する
                        $.ajax({
                            url: '../../classes/updateKaiinCEU.php',
                            type: 'POST',
                            data: {
                                category_kbn: getPersonalDevelopment[idx]['category_kbn'],
                                nendo_id: getPersonalDevelopment[idx]['nendo_id'],
                                ceusu: getPersonalDevelopment[idx]['ceusu'],
                                shutokubi: shutokubi,
                                chkCSCS: $('#chkCSCS').val(),
                                chkCPT: $('#chkCPT').val(),
                            }

                        }).done((data) => {
                            if (data == 0) {
                                return false;
                            } else {
                                // HIDDENデータをSESSIONに積込む処理
                                $.ajax({
                                    url: '../../classes/setPersonalDevelopmentDataToSess.php',
                                    type: 'POST',
                                    data: {

                                        //会員情報
                                        kaiin_no: getKaiinJoho[0],
                                        ceu_id: getPersonalDevelopment[idx]['ceu_id'],
                                        category_kbn: getPersonalDevelopment[idx]['category_kbn'],
                                        nendo_id: getPersonalDevelopment[idx]['nendo_id'],
                                        ceusu: getPersonalDevelopment[idx]['ceusu'],
                                        shutokubi: shutokubi,
                                        chkCSCS: $('#chkCSCS').val(),
                                        chkCPT: $('#chkCPT').val(),
                                        
                                        tranScreen: 'personalDevelopmentConfirm'
                                    }
                                })

                                    // Ajaxリクエストが成功した時発動
                                    .done((data) => {
                                        url = '../paymentSelectNoLogin/';
                                        $('form').attr('action', url);
                                        $('form').submit();
                                    })

                                    // Ajaxリクエストが失敗した時発動
                                    .fail((data) => {
                                        return false;
                                    })
                            }

                        }).fail((data) => {
                            return false;
                        });
                    }

                }).fail((data) => {
                    return false;
                });
            }


        });

        //内容を修正するボタン押下時処理
        $("#return").click(function () {

            url = '../personalDevelopment/';
            $('form').attr('action', url);
            $('form').submit();

        });
    });
})(jQuery);
