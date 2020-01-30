(function ($) {
    $(document).ready(function () {

        /********************************
        * TB決済発行取得
        ********************************/
        jQuery.ajax({
            url: '../../classes/getTbKessaiHakko.php',
        }).done((rtn) => {
            if (rtn == 0) {
                // rtn = 0 の場合は、該当なし
                return false;
            } else {
                getKessaiHakko = JSON.parse(rtn);

                //値を入れる配列
                var titleArr = [];
                var payArr = [];

                //値を入れる変数
                var titleVal = "";
                var payVal = ""
                $.each(getKessaiHakko, function (i, val) {
                    //配列に値セット
                    titleArr.push(val['item_title']);
                    payArr.push(val['pay']);

                    //画面表示
                    $('#kessai').append('<tr><th>' + val['item_title'] + '</th><td>' + Math.floor(val['pay']) + '円</td></tr>');
                });

                //配列の値を、カンマ区切りで変数に代入する
                $.each(titleArr, function () {
                    titleVal = titleVal + this + ', ';
                });
                $.each(payArr, function () {
                    payVal = payVal + this + ', ';
                });

                //hidden項目に値をセット
                $("#item_title").val(titleVal);
                $("#pay").val(payVal);
            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * TB会員情報取得
        ********************************/
        jQuery.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            if (rtn == 0) {
                // rtn = 0 の場合は、該当なし
                return false;
            } else {
                getTbkaiinJoho = JSON.parse(rtn);

                //hidden項目に値をセット
                $('#name_sei').val(getTbkaiinJoho['shimei_sei']);
                $('#name_mei').val(getTbkaiinJoho['shimei_mei']);
                $('#name_sei_kana').val(getTbkaiinJoho['furigana_sei']);
                $('#name_mei_kana').val(getTbkaiinJoho['furigana']);
                $('#tel').val(getTbkaiinJoho['tel']);
                $('#keitai_tel').val(getTbkaiinJoho['keitai_no']);
            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 支払方法選択ボタン押下時
        ********************************/
        $("#payment").click(function () {

            // HIDDENデータをSESSIONに積込む処理
            $.ajax({
                url: '../../classes/setUnpaidDataToSess.php',
                type: 'POST',
                data: {
                    //TB決済発行のテーブル項目
                    item_title: $("#item_title").val(),
                    pay: $("#pay").val(),

                    //TB会員情報のテーブル項目
                    name_mei: $("#name_mei").val(),
					name_sei: $("#name_sei").val(),
					name_sei_kana: $("#name_sei_kana").val(),
                    name_mei_kana: $("#name_mei_kana").val(),
                    tel: $("#tel").val(),
					keitai_tel: $("#keitai_tel").val(),
                }
            }).done((data) => {
                url = '../paymentSelectNoLogin/';
                $('form').attr('action', url);
                $('form').submit();
            }).fail((data) => {
                return false;
            })

        });
    });

})(jQuery);