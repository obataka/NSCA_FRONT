(function ($) {
    $(document).ready(function () {
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
                $('#kaiin_no').text(getKaiinJoho[0]);
                $('#shimei').text(getKaiinJoho['shimei_sei'] + ' ' + getKaiinJoho['shimei_mei']);
                $('#furigana').text(getKaiinJoho['furigana_sei'] + ' ' + getKaiinJoho['furigana_mei']);
                $('#tel').text(getKaiinJoho['tel']);

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
                        $('#address').text(mail_1);
                    } else if (getKaiinSonota['email_2_oshirase_uketori'] != "") {
                        $('#address').text(mail_2);
                    }

                }).fail((rtn) => {
                    return false;
                });

            }
        }).fail((rtn) => {
            return false;
        });

        /****************
        *CEU管理費を取得
        *****************/
       $.ajax({
        url: '../../classes/getCeuKanrihi.php',
    }).done((rtn) => {
        // rtn = 0 の場合
        if (rtn == 0) {
            return false;
        } else {
            console.log(rtn);
            getceuKanrihi = JSON.parse(rtn);
            
        }
            
    }).fail((rtn) => {
        return false;
    });

    });
})(jQuery);
