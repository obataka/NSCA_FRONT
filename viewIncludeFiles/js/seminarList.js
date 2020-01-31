(function ($) {
    $(document).ready(function () {

        //全レコードを格納する配列
        var getCeuConference = [];
        var getCeuJoho = [];
        var getCeuSokai = [];
        var getCeuToreken = [];

        //イベント種別名称を格納する配列
        var getEventSbt = [];

        /********************************
       * 初期表示処理
       ********************************/
        
        jQuery.ajax({
            url: '../../classes/getEventSbt.php',
        }).done((rtn) => {
            getEventSbt = JSON.parse(rtn);
            
            $.each(getEventSbt, function(i, val) {
                //イベント区分を表示させる
                $('#event').append(
                    '<tr id="tr_' + val['meisho_cd'] + '">'+
                        '<th>'+
                            '<span class="sub">' + val['meisho'] + '</span>' +
                        '</th>'+
                        '<td>'+
                        '</td>'+
                    '</tr>'
                );
            });

            //CEUカンファレンス情報
            jQuery.ajax({
                url: '../../classes/getCeuConference.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuConference = JSON.parse(rtn);
                    $.each(getCeuConference, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>'+
                                '<td>'+ 
                                    val['shutoku_naiyo'] + 
                                '</td>'+
                                '<td>'+ 
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" onclick="location.href=\'#\'"><span>申請</span></button>' +
                                    '</div>'+
                                '</td>'+
                            '<tr>'
                        );
                    });

                }
            }).fail((rtn) => {
                return false;
            });

            //CEU情報
            jQuery.ajax({
                url: '../../classes/getCeuJoho.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuJoho = JSON.parse(rtn);
                    $.each(getCeuJoho, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>'+
                                    '<td>'+ 
                                        val['shutoku_naiyo'] + 
                                    '</td>'+
                                    '<td>'+ 
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" onclick="location.href=\'#\'"><span>申請</span></button>' +
                                    '</div>'+
                                '</td>'+
                            '<tr>'
                        );
                    });
                }
            }).fail((rtn) => {
                return false;
            });

            //CEU総会情報
            jQuery.ajax({
                url: '../../classes/getCeuSokai.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuSokai = JSON.parse(rtn);
                    $.each(getCeuSokai, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>'+
                                '<td>'+ 
                                    val['shutoku_naiyo'] + 
                                '</td>'+
                                '<td>'+ 
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" onclick="location.href=\'#\'"><span>申請</span></button>' +
                                    '</div>'+
                                '</td>'+
                            '<tr>'
                        );
                    });
                }
            }).fail((rtn) => {
                return false;
            });

            //トレ検情報
            jQuery.ajax({
                url: '../../classes/getToreken.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuToreken = JSON.parse(rtn);
                    $.each(getCeuToreken, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>'+
                                '<td>'+ 
                                    val['kentei_title'] + 
                                '</td>'+
                                '<td>'+ 
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" onclick="location.href=\'#\'"><span>申請</span></button>' +
                                    '</div>'+
                                '</td>'+
                            '<tr>'
                        );
                    });
                }
            }).fail((rtn) => {
                return false;
            });

        }).fail((rtn) => {
            return false;
        });

        //申請ボタン押下時処理
        $(document).on("click", ".shinsei", function () {
            if ($('#kaiin_no').val() != "") {
                //申請ボタンが押下された行を取得する
            } else {

            }
        });
    });

})(jQuery);