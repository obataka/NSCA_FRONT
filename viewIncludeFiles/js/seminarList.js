(function ($) {
    $(document).ready(function () {

        //全レコードを格納する配列
        var getCeuConference = [];
        var getCeuJoho = [];
        var getCeuSokai = [];
        var getCeuToreken = [];

        //イベント種別名称を格納する配列
        var getEventSbt = [];

        //イベント種別を格納する配列
        var ceu_conference_kbn = [];
        var ceu_joho_kbn = [];
        var ceu_sokai_kbn = [];
        var toreken_kbn = [];

        /********************************
       * イベント種別名称取得
       ********************************/
        //CEUカンファレンス情報
        jQuery.ajax({
            url: '../../classes/getEventSbt.php',
        }).done((rtn) =>{
            getEventSbt = JSON.parse(rtn);
            $.each(getEventSbt, function () {

            });
        }).fail((rtn) =>{
            return false;
        });
        /********************************
       * 表示処理
       ********************************/
        //CEUカンファレンス情報
        jQuery.ajax({
            url: '../../classes/getCeuConference.php',
        }).done((rtn) =>{
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getCeuConference = JSON.parse(rtn);
                console.log(getCeuConference);
                $.each(getCeuConference, function (i, val) {
                    
                });

            }
        }).fail((rtn) =>{
            return false;
        });

        //CEU情報
        jQuery.ajax({
            url: '../../classes/getCeuJoho.php',
        }).done((rtn) =>{
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getCeuJoho = JSON.parse(rtn);
                console.log(getCeuJoho);
                $.each(getCeuJoho, function (i, val) {
                    
                });
            }
        }).fail((rtn) =>{
            return false;
        });

        //CEU総会情報
        jQuery.ajax({
            url: '../../classes/getCeuSokai.php',
        }).done((rtn) =>{
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getCeuSokai = JSON.parse(rtn);
                console.log(getCeuSokai);
                $.each(getCeuSokai, function (i, val) {
                    
                });
            }
        }).fail((rtn) =>{
            return false;
        });

        //トレ検情報
        jQuery.ajax({
            url: '../../classes/getToreken.php',
        }).done((rtn) =>{
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getCeuToreken = JSON.parse(rtn);
                console.log(getCeuToreken);
                $.each(getCeuToreken, function (i, val) {
                    
                });
            }
        }).fail((rtn) =>{
            return false;
        });

    });

})(jQuery);