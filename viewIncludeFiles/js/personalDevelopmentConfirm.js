(function ($) {
    $(document).ready(function () {

        //資格表示
        if ($('#chkCSCS').val() == 1) {
            $('#shikaku').append('CSCS<br>');
        }

        if ($('#chkCPT').val() == 1) {
            $('#shikaku').append('NSCA-CPT<br>');
        }

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
            }
        }).fail((rtn) => {
            return false;
        });

        //パーソナルディベロップメント情報を取得する
        $.ajax({
            url: '../../classes/getPersonalDevelopmentData.php',
            type: 'POST',
            data: {
                kaiin_sbt: $('#kaiin_sbt').val()
            }
        }).done((data) => {

        }).fail((data) => {
            return false;
        });


        //申告ボタン押下時処理
        $("#next").click(function () {

        });

        //内容を修正するボタン押下時処理
        $("#return").click(function () {

            url = '../personalDevelopment/';
            $('form').attr('action', url);
            $('form').submit();

        });
    });
})(jQuery);
